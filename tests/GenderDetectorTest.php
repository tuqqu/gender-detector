<?php

declare(strict_types=1);

namespace GenderDetector\Tests;

use GenderDetector\Gender;
use GenderDetector\GenderDetector;
use GenderDetector\Country;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class GenderDetectorTest extends TestCase
{
    #[DataProvider('provideNameData')]
    public function testGetGender(string $name, string|Country|null $region, Gender $expectedGender): void
    {
        $detector = new GenderDetector();
        $gender = $detector->getGender($name, $region);

        self::assertSame($expectedGender, $gender);
    }

    #[DataProvider('provideNameDataForCustomDict')]
    public function testAddDictionaryFile(string $name, Gender $expectedGender): void
    {
        $detector = new GenderDetector(__DIR__ . '/fixtures/custom_dict.txt');
        $gender = $detector->getGender($name);

        self::assertSame($expectedGender, $gender);
    }

    public static function provideNameData(): array
    {
        return [
            [
                'Robert',
                null,
                Gender::Male,
            ],
            [
                'Angel',
                Country::Usa,
                Gender::Unisex,
            ],
            [
                'Jamie',
                null,
                Gender::MostlyFemale,
            ],
            [
                'Jamie',
                Country::Belgium,
                Gender::Female,
            ],
            [
                'Jamie',
                Country::GreatBritain,
                Gender::MostlyMale,
            ],
            [
                'Robin',
                null,
                Gender::MostlyMale,
            ],
            [
                'Robin',
                Country::Usa,
                Gender::MostlyFemale,
            ],
            [
                'Robin',
                Country::France,
                Gender::Male,
            ],
            [
                'Robin',
                Country::Ireland,
                Gender::Unisex,
            ],
            [
                'Robin',
                'US',
                Gender::MostlyFemale,
            ],
            [
                'Robin',
                'fr',
                Gender::Male,
            ],
            [
                'Robin',
                'IE',
                Gender::Unisex,
            ],
            [
                'Geirþrúður',
                null,
                Gender::Female,
            ],
        ];
    }

    public static function provideNameDataForCustomDict(): array
    {
        return [
            [
                'Varys',
                Gender::Male,
            ],
            [
                'Tyrion',
                Gender::Male,
            ],
            [
                'Cercei',
                Gender::Female,
            ],
        ];
    }
}
