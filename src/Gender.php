<?php

declare(strict_types=1);

namespace GenderDetector;

enum Gender
{
    case Male;
    case MostlyMale;
    case Female;
    case MostlyFemale;
    case Unisex;
}
