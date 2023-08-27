<?php

declare(strict_types=1);

namespace GenderDetector;

enum Country: string
{
    case GreatBritain = 'great_britain';
    case Ireland = 'ireland';
    case Usa = 'usa';
    case Italy = 'italy';
    case Malta = 'malta';
    case Portugal = 'portugal';
    case Spain = 'spain';
    case France = 'france';
    case Belgium = 'belgium';
    case Luxembourg = 'luxembourg';
    case TheNetherlands = 'the_netherlands';
    case EastFrisia = 'east_frisia';
    case Germany = 'germany';
    case Austria = 'austria';
    case Swiss = 'swiss';
    case Iceland = 'iceland';
    case Denmark = 'denmark';
    case Norway = 'norway';
    case Sweden = 'sweden';
    case Finland = 'finland';
    case Estonia = 'estonia';
    case Latvia = 'latvia';
    case Lithuania = 'lithuania';
    case Poland = 'poland';
    case CzechRepublic = 'czech_republic';
    case Slovakia = 'slovakia';
    case Hungary = 'hungary';
    case Romania = 'romania';
    case Bulgaria = 'bulgaria';
    case BosniaAndHerzegovina = 'bosnia_and_herzegovina';
    case Croatia = 'croatia';
    case Kosovo = 'kosovo';
    case NorthMacedonia = 'north_macedonia';
    case Montenegro = 'montenegro';
    case Serbia = 'serbia';
    case Slovenia = 'slovenia';
    case Albania = 'albania';
    case Greece = 'greece';
    case Russia = 'russia';
    case Belarus = 'belarus';
    case Moldova = 'moldova';
    case Ukraine = 'ukraine';
    case Armenia = 'armenia';
    case Azerbaijan = 'azerbaijan';
    case Georgia = 'georgia';
    case Kazakhstan = 'kazakhstan';
    case Kyrgyzstan = 'kyrgyzstan';
    case Tajikistan = 'tajikistan';
    case Turkmenistan = 'turkmenistan';
    case Uzbekistan = 'uzbekistan';
    case Turkey = 'turkey';
    case Arabia = 'arabia';
    case Iran = 'iran';
    case Israel = 'israel';
    case China = 'china';
    case India = 'india';
    case SriLanka = 'sri_lanka';
    case Japan = 'japan';
    case Korea = 'korea';
    case Vietnam = 'vietnam';
    case OtherCountries = 'other_countries';
}
