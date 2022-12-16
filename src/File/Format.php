<?php

declare(strict_types=1);

namespace GenderDetector\File;

use GenderDetector\Country;
use GenderDetector\Gender;

/**
 * This class contains file format details and must not be used directly.
 *
 * @internal backward compatibility is not promised
 */
final class Format
{
    public const COUNTRY_OFFSET_MAP = [
        Country::GREAT_BRITAIN => 0,
        Country::IRELAND => 1,
        Country::USA => 2,
        Country::ITALY => 3,
        Country::MALTA => 4,
        Country::PORTUGAL => 5,
        Country::SPAIN => 6,
        Country::FRANCE => 7,
        Country::BELGIUM => 8,
        Country::LUXEMBOURG => 9,
        Country::THE_NETHERLANDS => 10,
        Country::EAST_FRISIA => 11,
        Country::GERMANY => 12,
        Country::AUSTRIA => 13,
        Country::SWISS => 14,
        Country::ICELAND => 15,
        Country::DENMARK => 16,
        Country::NORWAY => 17,
        Country::SWEDEN => 18,
        Country::FINLAND => 19,
        Country::ESTONIA => 20,
        Country::LATVIA => 21,
        Country::LITHUANIA => 22,
        Country::POLAND => 23,
        Country::CZECH_REPUBLIC => 24,
        Country::SLOVAKIA => 25,
        Country::HUNGARY => 26,
        Country::ROMANIA => 27,
        Country::BULGARIA => 28,
        Country::BOSNIA_AND_HERZEGOVINA => 29,
        Country::CROATIA => 30,
        Country::KOSOVO => 31,
        Country::MACEDONIA => 32,
        Country::NORTH_MACEDONIA => 32,
        Country::MONTENEGRO => 33,
        Country::SERBIA => 34,
        Country::SLOVENIA => 35,
        Country::ALBANIA => 36,
        Country::GREECE => 37,
        Country::RUSSIA => 38,
        Country::BELARUS => 39,
        Country::MOLDOVA => 40,
        Country::UKRAINE => 41,
        Country::ARMENIA => 42,
        Country::AZERBAIJAN => 43,
        Country::GEORGIA => 44,
        Country::KAZAKHSTAN => 45,
        Country::KYRGYZSTAN => 45,
        Country::TAJIKISTAN => 45,
        Country::TURKMENISTAN => 45,
        Country::UZBEKISTAN => 45,
        Country::TURKEY => 46,
        Country::ARABIA => 47,
        Country::PERSIA => 47,
        Country::IRAN => 47,
        Country::ISRAEL => 48,
        Country::CHINA => 49,
        Country::INDIA => 50,
        Country::SRI_LANKA => 50,
        Country::JAPAN => 51,
        Country::KOREA => 52,
        Country::VIETNAM => 53,
        Country::OTHER_COUNTRIES => 54,
    ];

    public const GENDER_DEFINITIONS = [
        'M' => Gender::MALE,
        '1M' => Gender::MALE,
        '?M' => Gender::MOSTLY_MALE,
        '?' => Gender::UNISEX,
        '?F' => Gender::MOSTLY_FEMALE,
        '1F' => Gender::FEMALE,
        'F' => Gender::FEMALE,
    ];
}
