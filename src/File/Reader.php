<?php

declare(strict_types=1);

namespace GenderDetector\File;

use GenderDetector\File\FileUtils as utils;
use GenderDetector\Exception\FileReadingException;

use function fclose;
use function fgets;
use function file_exists;
use function in_array;
use function is_readable;
use function is_resource;
use function mb_strtolower;
use function mb_substr;
use function rtrim;
use function sprintf;
use function trim;
use function fopen;

/**
 * Reads gender data from a file.
 *
 * @internal
 */
final class Reader
{
    /** @var resource|closed-resource */
    private mixed $handle;
    private readonly string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;

        if (!file_exists($this->filename) || !is_readable($this->filename)) {
            throw new FileReadingException(sprintf('File "%s" is not readable', $filename));
        }

        $handle = fopen($this->filename, 'rb');

        if ($handle === false) {
            throw new FileReadingException(sprintf('File "%s" cannot be opened', $this->filename));
        }

        $this->handle = $handle;
    }

    public function __destruct()
    {
        $this->close();
    }

    /**
     * @return iterable<int, NameRecord>
     */
    public function readLine(): iterable
    {
        /** @psalm-suppress PossiblyInvalidArgument */
        while (false !== ($line = fgets($this->handle))) {
            if (self::skipLine($line)) {
                continue;
            }

            $name = mb_strtolower(trim(mb_substr($line, utils::NAME_OFFSET_START, utils::NAME_OFFSET_END)));
            $gender = rtrim(mb_substr($line, utils::GENDER_OFFSET_START, utils::GENDER_OFFSET_END));
            $frequencies = mb_substr($line, utils::FREQUENCY_OFFSET_START, utils::FREQUENCY_OFFSET_END);

            yield new NameRecord(
                name: $name,
                gender: utils::getGenderByCode($gender) ?? throw new FileReadingException(sprintf('Unknown gender code "%s"', $gender)),
                frequencies: new CountryFrequencyList($frequencies),
            );
        }

        $this->close();
    }

    private function close(): void
    {
        if (!is_resource($this->handle)) {
            return;
        }

        if (fclose($this->handle) === false) {
            throw new FileReadingException(sprintf('Error while closing file "%s"', $this->filename));
        }
    }

    private static function skipLine(string $line): bool
    {
        return in_array($line[0], utils::IGNORE_CHARS, true);
    }
}
