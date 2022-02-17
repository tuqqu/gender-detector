<?php

declare(strict_types=1);

namespace GenderDetector;

use GenderDetector\Exception\{FileReadingException, GenderDetectingException};
use GenderDetector\File\{Format, Reader};

final class GenderDetector
{
    private const DICT_PATH = __DIR__ . '/../data/nam_dict.txt';

    /** @var array<string, array<string, string>> */
    private array $names = [];
    private array $consumedFiles = [];
    private ?string $unknownGender = null;

    /**
     * @throws FileReadingException
     */
    public function __construct(string $filepath = self::DICT_PATH)
    {
        $this->consumeFileContents($filepath);
    }

    /**
     * @throws FileReadingException
     */
    public function addDictionaryFile(string $path): void
    {
        $this->consumeFileContents($path);
    }

    public function setUnknownGender(string $unknown): void
    {
        $this->unknownGender = $unknown;
    }

    /**
     * @throws GenderDetectingException
     */
    public function detect(string $name, ?string $country = null): ?string
    {
        $country = self::sanitizeCountry($country);
        $name = self::sanitizeName($name);

        if (!isset($this->names[$name])) {
            return $this->unknownGender;
        }

        $best = null;

        if (1 === \count($this->names[$name])) {
            $best = \key($this->names[$name]);
        }

        if (null !== $country && null === $best) {
            $best = $this->computeBestForCountry($name, $country);
        }

        if (null === $best) {
            $best = $this->computeBestForAllCountries($name);
        }

        return Format::GENDER_DEFINITIONS[$best] ?? $this->unknownGender;
    }

    /**
     * @throws FileReadingException
     */
    private function consumeFileContents(string $filepath): void
    {
        if (!\in_array($filepath, $this->consumedFiles, true)) {
            foreach ((new Reader($filepath))->readName() as [$name, $gender, $frequencies]) {
                $this->names[$name][$gender] = $frequencies;
            }

            $this->consumedFiles[] = $filepath;
        }
    }

    private function computeBestForAllCountries(string $name): ?string
    {
        $maxSum = $maxCount = 0;
        $best = null;

        foreach ($this->names[$name] as $gender => $frequencies) {
            $frequencies = \str_split(\str_replace(' ', '', $frequencies));
            $count = \count($frequencies);
            $sum = 0;

            foreach ($frequencies as $frequency) {
                $sum += \hexdec($frequency);
            }

            if ($sum > $maxSum || ($sum === $maxSum && $count > $maxCount)) {
                $maxSum = $sum;
                $maxCount = $count;
                $best = $gender;
            }
        }

        return $best;
    }

    private function computeBestForCountry(string $name, string $country): ?string
    {
        $maxFreq = 0;
        $best = null;

        foreach ($this->names[$name] as $gender => $frequencies) {
            $frequency = (int) $frequencies[Format::COUNTRY_OFFSET_MAP[$country]];

            if ($frequency > $maxFreq) {
                $maxFreq = $frequency;
                $best = $gender;
            }
        }

        return $best;
    }

    /**
     * @throws GenderDetectingException
     */
    private static function sanitizeCountry(?string $country): ?string
    {
        if ($country === null) {
            return null;
        }

        $country = \mb_strtolower($country);

        if (!\in_array($country, Country::LIST, true)) {
            throw new GenderDetectingException(
                \sprintf('Country or region with the name "%s" cannot be recognised', $country)
            );
        }

        return $country;
    }

    private static function sanitizeName(string $name): string
    {
        return \str_replace([' ', '-'], '+', \mb_strtolower($name));
    }
}
