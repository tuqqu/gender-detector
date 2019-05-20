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

    /** @var string */
    private $filename;

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

        if (!$handle) {
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
     * @throws FileReadingException
     */
    public function readName(): \Generator
    {
        while (false !== ($line = \fgets($this->handle))) {
            if (\in_array($line[0], self::IGNORE, false)) {
                continue;
            }

            yield [
                \strtolower(\trim(\substr($line, 2, 28))),
                \rtrim(\substr($line, 0, 2)),
                \substr($line, 30, 56)
            ];
        }

        $this->close();
    }

    /**
     * @throws FileReadingException
     */
    public function close(): void
    {
        if (!\is_resource($this->handle)) {
            return;
        }

        if (false === \fclose($this->handle)) {
            throw new FileReadingException(\sprintf('Error when closing the file: "%s".', $this->filename));
        }
    }
}
