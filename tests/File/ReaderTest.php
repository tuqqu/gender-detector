<?php

declare(strict_types=1);

namespace GenderDetector\Tests\File;

use GenderDetector\File\Reader;
use PHPUnit\Framework\TestCase;

final class ReaderTest extends TestCase
{
    private const FILE_PATH = __DIR__ . '/../fixtures/custom_dict.txt';

    /**
     * @dataProvider readNameData
     */
    public function testReadName(string $expectedName, string $expectedGender, string $expectedFrequencies): void
    {
        $reader = new Reader(self::FILE_PATH);
        $nameData = $reader->readName();
        [$name, $gender, $freqs] = $nameData->current();

        self::assertSame($expectedName, $name);
        self::assertEquals($expectedGender, $gender);
        self::assertEquals($expectedFrequencies, $freqs);
    }

    public function readNameData(): array
    {
        return [
            [
                'eddard',
                'M',
                '            4511            2                           '
            ],
        ];
    }
}
