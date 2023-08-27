<?php

declare(strict_types=1);

namespace GenderDetector\File;

use GenderDetector\Country;
use GenderDetector\Gender;

/**
 * File format details.
 *
 * @internal
 */
final class FileUtils
{
    public const IGNORE_CHARS = ['#', '='];
    public const GENDER_OFFSET_START = 0;
    public const GENDER_OFFSET_END = 2;
    public const FREQUENCY_OFFSET_START = 30;
    public const FREQUENCY_OFFSET_END = 56;
    public const NAME_OFFSET_START = 2;
    public const NAME_OFFSET_END = 28;

    public static function getOffsetByCountry(Country $country): int
    {
        return match ($country) {
            Country::GreatBritain => 0,
            Country::Ireland => 1,
            Country::Usa => 2,
            Country::Italy => 3,
            Country::Malta => 4,
            Country::Portugal => 5,
            Country::Spain => 6,
            Country::France => 7,
            Country::Belgium => 8,
            Country::Luxembourg => 9,
            Country::TheNetherlands => 10,
            Country::EastFrisia => 11,
            Country::Germany => 12,
            Country::Austria => 13,
            Country::Swiss => 14,
            Country::Iceland => 15,
            Country::Denmark => 16,
            Country::Norway => 17,
            Country::Sweden => 18,
            Country::Finland => 19,
            Country::Estonia => 20,
            Country::Latvia => 21,
            Country::Lithuania => 22,
            Country::Poland => 23,
            Country::CzechRepublic => 24,
            Country::Slovakia => 25,
            Country::Hungary => 26,
            Country::Romania => 27,
            Country::Bulgaria => 28,
            Country::BosniaAndHerzegovina => 29,
            Country::Croatia => 30,
            Country::Kosovo => 31,
            Country::NorthMacedonia => 32,
            Country::Montenegro => 33,
            Country::Serbia => 34,
            Country::Slovenia => 35,
            Country::Albania => 36,
            Country::Greece => 37,
            Country::Russia => 38,
            Country::Belarus => 39,
            Country::Moldova => 40,
            Country::Ukraine => 41,
            Country::Armenia => 42,
            Country::Azerbaijan => 43,
            Country::Georgia => 44,
            Country::Kazakhstan,
            Country::Uzbekistan,
            Country::Turkmenistan,
            Country::Tajikistan,
            Country::Kyrgyzstan => 45,
            Country::Turkey => 46,
            Country::Arabia,
            Country::Iran => 47,
            Country::Israel => 48,
            Country::China => 49,
            Country::India,
            Country::SriLanka => 50,
            Country::Japan => 51,
            Country::Korea => 52,
            Country::Vietnam => 53,
            Country::OtherCountries => 54,
        };
    }

    public static function getGenderByCode(string $code): ?Gender
    {
        return match ($code) {
            'M', '1M' => Gender::Male,
            '?M' => Gender::MostlyMale,
            '1F', 'F' => Gender::Female,
            '?F' => Gender::MostlyFemale,
            '?' => Gender::Unisex,
            default => null,
        };
    }
}
