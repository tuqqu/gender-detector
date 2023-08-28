<?php

declare(strict_types=1);

namespace GenderDetector;

use GenderDetector\File\NameRecord;
use GenderDetector\File\Reader;

use function count;
use function hexdec;
use function mb_strtolower;
use function str_replace;
use function is_string;

final class GenderDetector
{
    private const DICT_PATH = __DIR__ . '/../data/nam_dict.txt';

    /** @var array<string, list<NameRecord>> */
    private array $names = [];

    public function __construct(string $dictPath = self::DICT_PATH)
    {
        $this->consumeDictFile($dictPath);
    }

    public function addDictionaryFile(string $dictPath): void
    {
        $this->consumeDictFile($dictPath);
    }

    public function getGender(string $name, string|Country|null $country = null): ?Gender
    {
        if (is_string($country)) {
            $country = Country::fromISO3166($country);
        }

        $name = self::sanitizeName($name);

        if (!isset($this->names[$name])) {
            return null;
        }

        $best = null;

        if (count($this->names[$name]) === 1) {
            $best = $this->names[$name][0]->gender;
        }

        if ($country !== null && $best === null) {
            $best = $this->computeBestForCountry($name, $country);
        }

        if ($best === null) {
            $best = $this->computeBestForAllCountries($name);
        }

        return $best;
    }

    private function consumeDictFile(string $dictPath): void
    {
        $reader = new Reader($dictPath);

        foreach ($reader->readLine() as $nameRecord) {
            $this->names[$nameRecord->name][] = $nameRecord;
        }
    }

    private function computeBestForAllCountries(string $name): ?Gender
    {
        $maxSum = 0;
        $maxCount = 0;
        $best = null;

        foreach ($this->names[$name] as $nameRecord) {
            $frequencies = $nameRecord->frequencies->getAll();
            $count = count($frequencies);
            $sum = 0;

            foreach ($frequencies as $frequency) {
                $sum += hexdec($frequency);
            }

            if ($sum > $maxSum || ($sum === $maxSum && $count > $maxCount)) {
                $maxSum = $sum;
                $maxCount = $count;
                $best = $nameRecord->gender;
            }
        }

        return $best;
    }

    private function computeBestForCountry(string $name, Country $country): ?Gender
    {
        $maxFreq = 0;
        $best = null;

        foreach ($this->names[$name] as $nameRecord) {
            $frequency = $nameRecord->frequencies->getForCountry($country);

            if ($frequency > $maxFreq) {
                $maxFreq = $frequency;
                $best = $nameRecord->gender;
            }
        }

        return $best;
    }

    private static function sanitizeName(string $name): string
    {
        return mb_strtolower(str_replace([' ', '-'], '+', $name));
    }
}
