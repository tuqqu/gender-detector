<?php

declare(strict_types=1);

namespace GenderDetector\File;

use GenderDetector\Exception\FileReadingException;

/**
 * @internal backward compatibility is not promised
 */
final class Reader
{
    private const IGNORE = ['#', '='];

    /** @var resource */
    private $handle;
    private string $filename;

    /**
     * @throws FileReadingException
     */
    public function __construct(string $filename)
    {
        if (!\file_exists($filename) || !\is_readable($filename)) {
            throw new FileReadingException(
                \sprintf('File "%s" either does not exist or cannot be read', $filename)
            );
        }

        $this->filename = $filename;
        $handle = \fopen($this->filename, 'rb');

        if ($handle === false) {
            throw new FileReadingException(
                \sprintf('File "%s" cannot be opened', $this->filename)
            );
        }

        $this->handle = $handle;
    }

    /**
     * @throws FileReadingException
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * @psalm-return iterable<int, array{lowercase-string, string, string}>
     * @throws FileReadingException
     */
    public function readName(): iterable
    {
        while (false !== ($line = \fgets($this->handle))) {
            if (\in_array($line[0], self::IGNORE, true)) {
                continue;
            }

            yield [
                \mb_strtolower(\trim(\mb_substr($line, 2, 28))),
                \rtrim(\mb_substr($line, 0, 2)),
                \mb_substr($line, 30, 56),
            ];
        }

        $this->close();
    }

    /**
     * @throws FileReadingException
     * @psalm-suppress DocblockTypeContradiction
     * @psalm-suppress InvalidPropertyAssignmentValue
     */
    private function close(): void
    {
        if (!\is_resource($this->handle)) {
            return;
        }

        if (false === \fclose($this->handle)) {
            throw new FileReadingException(\sprintf('Error when closing the file: "%s".', $this->filename));
        }
    }
}
