<?php

declare(strict_types=1);

namespace GenderDetector\Tests;

use GenderDetector\{Country, Gender, GenderDetector};
use PHPUnit\Framework\TestCase;

final class GenderDetectorTest extends TestCase
{
    /**
     * @dataProvider detectionData
     */
    public function testDetect(string $name, ?string $country, string $expectedGender): void
    {
        $detector = new GenderDetector();

        self::assertSame($detector->detect($name, $country), $expectedGender);
    }

    /**
     * @dataProvider additionalDetectionData
     */
    public function testAddDictionaryFile(string $name, string $expectedGender): void
    {
        $detector = new GenderDetector(__DIR__ . '/fixtures/custom_dict.txt');

        self::assertSame($detector->detect($name), $expectedGender);
    }

    public function detectionData(): array
    {
        return [
            [
                'Robert',
                null,
                Gender::MALE,
            ],
            [
                'Angel',
                Country::USA,
                Gender::UNISEX,
            ],
            [
                'Jamie',
                null,
                Gender::MOSTLY_FEMALE,
            ],
            [
                'Jamie',
                Country::BELGIUM,
                Gender::FEMALE,
            ],
            [
                'Jamie',
                Country::GREAT_BRITAIN,
                Gender::MOSTLY_MALE,
            ],
        ];
    }

    public function additionalDetectionData(): array
    {
        return [
            [
                'Varys',
                Gender::MALE,
            ],
            [
                'Tyrion',
                Gender::MALE,
            ],
            [
                'Cercei',
                Gender::FEMALE,
            ],
        ];
    }
}
