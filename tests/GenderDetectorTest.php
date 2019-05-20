<?php

declare(strict_types=1);

namespace GenderDetector\Tests;

use GenderDetector\{Country, Gender, GenderDetector};
use PHPUnit\Framework\TestCase;

final class GenderDetectorTest extends TestCase
{
    /**
     * @covers \GenderDetector\GenderDetector
     * @dataProvider provideData
     */
    public function testDetecting(array $data): void
    {
        self::assertEquals(
            (new GenderDetector())->detect($data['name'], $data['country']),
            $data['gender']
        );
    }

    public function provideData(): array
    {
        return [
            [
                [
                    'name' => 'Robert',
                    'country' => null,
                    'gender' => Gender::MALE
                ],
            ],
            [
                [
                    'name' => 'Angel',
                    'country' => Country::USA,
                    'gender' => Gender::UNISEX
                ],
            ],
            [
                [
                    'name' => 'Jamie',
                    'country' => null,
                    'gender' => Gender::MOSTLY_FEMALE
                ],
            ],
            [
                [
                    'name' => 'Jamie',
                    'country' => Country::BELGIUM,
                    'gender' => Gender::FEMALE
                ],
            ],
            [
                [
                    'name' => 'Jamie',
                    'country' => Country::GREAT_BRITAIN,
                    'gender' => Gender::MOSTLY_MALE
                ],
            ],
        ];
    }
}
