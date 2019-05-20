<?php

declare(strict_types=1);

namespace ChickMate\Tests;

use ChickMate\File\Reader;
use PHPUnit\Framework\TestCase;

final class ReaderTest extends TestCase
{
    private const PATH = __DIR__ . '/fixtures/';

    /**
     * @covers \ChickMate\File\Reader
     * @dataProvider provideValidData
     */
    public function testValidReading(array $data): void
    {
        $reader = new Reader(self::PATH . $data['filename']);
        $nameData = $reader->readName();
        [$name, $gender, $freqs] = $nameData->current();

        self::assertEquals($name, $data['name']);
        self::assertEquals($gender, $data['gender']);
        self::assertEquals($freqs, $data['freqs']);
    }

    public function provideValidData(): array
    {
        return [
            [
                [
                    'filename' => 'custom_dict.txt',
                    'name' => 'eddard',
                    'gender' => 'M',
                    'freqs' => '            4511            2                           '
                ],
            ],
        ];
    }
}
