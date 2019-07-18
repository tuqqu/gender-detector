## Gender Detector

GenderDetector is a PHP package that detects the gender of a person based on first name. 
It uses the data file from the project 'gender.c' by Jörg Michael ([details](https://autohotkey.com/board/topic/20260-gender-verification-by-forename-cmd-line-tool-db/])).

### Installation

Install it with Composer

```bash
composer require tuqqu/gender-detector
```

### Usage

Its usage is simple, for any given name it will give you one of the following genders (strings): 
```
male
mostly_male
unisex
mostly_female
female
```
For an unknown name it will return `null`.
All the gender values are available as constants of the `GenderDetector\Gender` class for the convenience. 

```php
<?php 

$genderDetector = new GenderDetector\GenderDetector();

print $genderDetector->detect('Thomas');
// male

print $genderDetector->detect('Avery');
// unisex
```

I18N is fully supported

```php
<?php

print $genderDetector->detect('Želmíra');
// female

print $genderDetector->detect('Geirþrúður');
// female
```

You may specify a country or region.

```php
<?php

print $genderDetector->detect('Robin');
// mostly_male

print $genderDetector->detect('Robin', GenderDetector\Country::USA);
// mostly_female

print $genderDetector->detect('Robin', GenderDetector\Country::FRANCE);
// male

print $genderDetector->detect('Robin', GenderDetector\Country::IRELAND);
// unisex
```

All the countries are available as constants of the `GenderDetector\Country` class. 

For more details see [country list](/doc/country_list.md).


You may want to override the unknown name value. 
If it is the case, you need to set a new value with `setUnknownGender(string $unknown)` method.

```php
<?php

$genderDetector = new GenderDetector\GenderDetector();

print $genderDetector->detect('Doe');
// (null)

$genderDetector->setUnknownGender(GenderDetector\Gender::UNISEX);

print $genderDetector->detect('Doe');
// unisex
```

If you happen to have an alternative data file, you might pass it to the `GenderDetector` constructor's first argument. 
Additionally you may add new dictionary files with `addDictionaryFile(string $path)` method. 

```php
<?php

$genderDetector = new GenderDetector\GenderDetector('custom_file_path/dict.txt');
$genderDetector->addDictionaryFile('custom_file_path/another_dict.txt');
```

Note that each `GenderDetector` instantiation triggers file parsing, so you might want to avoid reading the same file twice.

### Licenses

The `GenderDetector` is licensed under the MIT License.

The data file `data/nam_dict.txt` is licensed under the GNU Free Documentation License.