<?php

declare(strict_types=1);

namespace GenderDetector\Tests\File;

use GenderDetector\Exception\FileReadingException;
use GenderDetector\File\NameRecord;
use GenderDetector\File\Reader;
use GenderDetector\Gender;
use PHPUnit\Framework\TestCase;

final class ReaderTest extends TestCase
{
    private const FILE_PATH = __DIR__ . '/../fixtures/custom_dict.txt';

    public function testReadName(): void
    {
        $reader = new Reader(self::FILE_PATH);
        $nameRecords = $reader->readLine();

        $firstRecord = null;

        foreach ($nameRecords as $nameRecord) {
            self::assertInstanceOf(NameRecord::class, $nameRecord);
            $firstRecord = $nameRecord;

            break;
        }

        self::assertNotNull($firstRecord);
        self::assertSame('eddard', $firstRecord->name);
        self::assertEquals(Gender::Male, $firstRecord->gender);
        self::assertEquals([4, 5, 1, 1, 2], $firstRecord->frequencies->getAll());
    }

    public function testInvalidFilePath(): void
    {
        $this->expectException(FileReadingException::class);

        new Reader('invalid_path.txt');
    }
}
