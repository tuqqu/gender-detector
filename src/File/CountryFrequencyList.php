<?php

declare(strict_types=1);

namespace GenderDetector\File;

use GenderDetector\Country;

use function str_split;
use function str_replace;

/**
 * @internal
 */
final class CountryFrequencyList
{
    public function __construct(
        private readonly string $frequencies,
    ) {}

    public function getForCountry(Country $country): int
    {
        return (int) $this->frequencies[FileUtils::getOffsetByCountry($country)];
    }

    /**
     * @return list<string>
     */
    public function getAll(): array
    {
        return str_split(str_replace(' ', '', $this->frequencies));
    }
}
