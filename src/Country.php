<?php

declare(strict_types=1);

namespace GenderDetector;

use function mb_strtoupper;

enum Country
{
    case GreatBritain;
    case Ireland;
    case Usa;
    case Italy;
    case Malta;
    case Portugal;
    case Spain;
    case France;
    case Belgium;
    case Luxembourg;
    case TheNetherlands;
    case EastFrisia;
    case Germany;
    case Austria;
    case Swiss;
    case Iceland;
    case Denmark;
    case Norway;
    case Sweden;
    case Finland;
    case Estonia;
    case Latvia;
    case Lithuania;
    case Poland;
    case CzechRepublic;
    case Slovakia;
    case Hungary;
    case Romania;
    case Bulgaria;
    case BosniaAndHerzegovina;
    case Croatia;
    case Kosovo;
    case NorthMacedonia;
    case Montenegro;
    case Serbia;
    case Slovenia;
    case Albania;
    case Greece;
    case Russia;
    case Belarus;
    case Moldova;
    case Ukraine;
    case Armenia;
    case Azerbaijan;
    case Georgia;
    case Kazakhstan;
    case Kyrgyzstan;
    case Tajikistan;
    case Turkmenistan;
    case Uzbekistan;
    case Turkey;
    case Arabia;
    case Iran;
    case Israel;
    case China;
    case India;
    case SriLanka;
    case Japan;
    case Korea;
    case Vietnam;
    case OtherCountries;

    public static function fromISO3166(string $iso3166): self
    {
        return match (mb_strtoupper($iso3166)) {
            'GB' => self::GreatBritain,
            'IE' => self::Ireland,
            'AU',
            'CA',
            'US' => self::Usa,
            'IT' => self::Italy,
            'MT' => self::Malta,
            'PT' => self::Portugal,
            'ES' => self::Spain,
            'FR' => self::France,
            'BE' => self::Belgium,
            'LU' => self::Luxembourg,
            'NL' => self::TheNetherlands,
            'DE' => self::Germany,
            'AT' => self::Austria,
            'CH' => self::Swiss,
            'IS' => self::Iceland,
            'DK' => self::Denmark,
            'NO' => self::Norway,
            'SE' => self::Sweden,
            'FI' => self::Finland,
            'EE' => self::Estonia,
            'LV' => self::Latvia,
            'LT' => self::Lithuania,
            'PL' => self::Poland,
            'CZ' => self::CzechRepublic,
            'SK' => self::Slovakia,
            'HU' => self::Hungary,
            'RO' => self::Romania,
            'BG' => self::Bulgaria,
            'BA' => self::BosniaAndHerzegovina,
            'HR' => self::Croatia,
            'XK' => self::Kosovo,
            'MK' => self::NorthMacedonia,
            'ME' => self::Montenegro,
            'RS' => self::Serbia,
            'SI' => self::Slovenia,
            'AL' => self::Albania,
            'GR' => self::Greece,
            'RU' => self::Russia,
            'BY' => self::Belarus,
            'MD' => self::Moldova,
            'UA' => self::Ukraine,
            'AM' => self::Armenia,
            'AZ' => self::Azerbaijan,
            'GE' => self::Georgia,
            'KZ' => self::Kazakhstan,
            'KG' => self::Kyrgyzstan,
            'TJ' => self::Tajikistan,
            'TM' => self::Turkmenistan,
            'UZ' => self::Uzbekistan,
            'TR' => self::Turkey,
            'AE',
            'QA',
            'SA',
            'BH',
            'EG' => self::Arabia,
            'CN',
            'HK',
            'TW' => self::China,
            'IN' => self::India,
            'JP' => self::Japan,
            'KP',
            'KR' => self::Korea,
            'VN' => self::Vietnam,
            'LK' => self::SriLanka,
            'IR' => self::Iran,
            'IL' => self::Israel,
            default => self::OtherCountries,
        };
    }
}
