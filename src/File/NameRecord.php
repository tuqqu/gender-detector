<?php

declare(strict_types=1);

namespace GenderDetector\File;

use GenderDetector\Gender;

/**
 * @internal
 */
final class NameRecord
{
    public function __construct(
        public readonly string $name,
        public readonly Gender $gender,
        public readonly CountryFrequencyList $frequencies,
    ) {}
}
