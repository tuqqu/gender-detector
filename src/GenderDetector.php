<?php

declare(strict_types=1);

namespace GenderDetector;

use GenderDetector\Exception\{GenderDetectingException, FileReadingException};
use GenderDetector\File\{Format, Reader};

final class GenderDetector
{
    private const DICT_PATH = __DIR__ . '/../data/nam_dict.txt';

    private $names = [];

    private $consumedFiles = [];

    /** @var string|null */
    private $unknownGender;

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
    public function addDictionaryFile(string $path): self
    {
        $this->consumeFileContents($path);

        return $this;
    }

    public function setUnknownGender(string $unknown): self
    {
        $this->unknownGender = $unknown;

        return $this;
    }

    /**
     * @throws GenderDetectingException
     */
    public function detect(string $name, ?string $country = null)
    {
        if (null !== $country && !\in_array($country, Country::LIST, false)) {
            throw new GenderDetectingException(
                \sprintf('Country or region with the name "%s" cannot be recognised', $country)
            );
        }

        $name = \str_replace([' ', '-'], '+', \strtolower($name));

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
}
