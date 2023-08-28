## Gender Detector

Get the most likely gender associated with a first name using PHP. 

This library utilizes data sourced from the `gender.c` project created by Jörg Michael ([details](https://autohotkey.com/board/topic/20260-gender-verification-by-forename-cmd-line-tool-db/])).

### Installation

Install it with Composer:

```bash
composer require tuqqu/gender-detector
```

### Usage

The usage is straightforward:

```php
$detector = new GenderDetector\GenderDetector();

$detector->getGender('Thomas');
// Gender::Male

$detector->getGender('Avery');
// Gender::Unisex
```

I18N is fully supported:

```php
$detector->getGender('Geirþrúður');
// Gender::Female
```

You can also specify a country:

```php
$detector->getGender('Robin');
// Gender::MostlyMale

$detector->getGender('Robin', 'US');
// Gender::MostlyFemale

$detector->getGender('Robin', 'FR');
// Gender::Male

$detector->getGender('Robin', 'IE');
// Gender::Unisex
```

Country codes are case-insensitive ISO 3166-1 alpha-2 codes.
Alternatively, you can utilize enum values; the complete list of values and codes can be found [here](/src/Country.php).

Full list of all the possible gender values are:

```php
enum Gender
{
    case Male;
    case MostlyMale;
    case Female;
    case MostlyFemale;
    case Unisex;
}
```

For an unknown name it will return `null`.


If you have an alternative data file, you can pass it as the first argument to the `GenderDetector` constructor. 
Additionally, you can add new dictionary files using the `addDictionaryFile(string $path)` method:

```php
$detector = new GenderDetector('custom_file_path/dict.txt');
$detector->addDictionaryFile('custom_file_path/another_dict.txt');
```

Note that each `GenderDetector` instantiation triggers file parsing, so you might want to avoid reading the same file twice.

### Licenses

The `GenderDetector` is licensed under the MIT License.

The data file `data/nam_dict.txt` is licensed under the GNU Free Documentation License.
