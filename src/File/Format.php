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
        Country::GERMANY => 11,
        Country::EAST_FRISIA => 12,
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
        Country::BOSNIA_AND_HERZEGOVINA => 28,
        Country::CROATIA => 29,
        Country::KOSOVO => 30,
        Country::MACEDONIA => 31,
        Country::NORTH_MACEDONIA => 31,
        Country::MONTENEGRO => 32,
        Country::SERBIA => 33,
        Country::SLOVENIA => 34,
        Country::ALBANIA => 35,
        Country::GREECE => 36,
        Country::RUSSIA => 37,
        Country::BELARUS => 38,
        Country::MOLDOVA => 39,
        Country::UKRAINE => 40,
        Country::ARMENIA => 41,
        Country::AZERBAIJAN => 42,
        Country::GEORGIA => 43,
        Country::KAZAKHSTAN => 44,
        Country::KYRGYZSTAN => 44,
        Country::TAJIKISTAN => 44,
        Country::TURKMENISTAN => 44,
        Country::UZBEKISTAN => 44,
        Country::TURKEY => 45,
        Country::ARABIA => 46,
        Country::PERSIA => 46,
        Country::IRAN => 46,
        Country::ISRAEL => 47,
        Country::CHINA => 48,
        Country::INDIA => 49,
        Country::SRI_LANKA => 49,
        Country::JAPAN => 50,
        Country::KOREA => 51,
        Country::VIETNAM => 52,
        Country::OTHER_COUNTRIES => 53
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
