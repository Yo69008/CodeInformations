
# CodeInformations

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/c0fe123c8e3f47cc8e5ae6758ca8f7e2)](https://www.codacy.com/app/Yo69008/CodeInformations?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Yo69008/CodeInformations&amp;utm_campaign=Badge_Grade)
[![Build Status](https://travis-ci.org/Yo69008/CodeInformations.svg?branch=master)](https://travis-ci.org/Yo69008/CodeInformations)

This API gives informations on a package. It makes it possible to obtain, if the information is indicated:
- the name of the package
- its version
- the language used
- dependencies required
- if the package is testable
- if it is distributable
- the license of the project
- a short description of the action of the API

## for use
basic usage for this component

Write the vendor's name and the package's name at the end of the URL :
www. site .com/ The vendor's name/The package's name

If the package and the vendor exist, the API search informations in the differents files and It displays what it found.

## Demo
Here is an example with a sebastien bergmann's package :

http://ydefarge.alwaysdata.net/sebastianbergmann/phpunit
```
{
    "testable": true,
    "distribuable": false,
    "package": "sebastianbergmann\/phpunit",
    "keywords": [
        "phpunit",
        "xunit",
        "testing"
    ],
    "name": "phpunit\/phpunit",
    "homepage": "https:\/\/phpunit.de\/",
    "license": "BSD-3-Clause",
    "author": [
        {
            "name": "Sebastian Bergmann",
            "email": "sebastian@phpunit.de",
            "role": "lead"
        }
    ],
    "description": "The PHP Unit Testing framework.",
    "dependencies": {
        "php": "^7.0",
        "ext-dom": "*",
        "ext-json": "*",
        "ext-libxml": "*",
        "ext-mbstring": "*",
        "ext-xml": "*",
        "myclabs\/deep-copy": "^1.3",
        "phar-io\/manifest": "^1.0.1",
        "phar-io\/version": "^1.0",
        "phpspec\/prophecy": "^1.7",
        "phpunit\/php-code-coverage": "^5.2",
        "phpunit\/php-file-iterator": "^1.4",
        "phpunit\/php-text-template": "^1.2",
        "phpunit\/php-timer": "^1.0.6",
        "phpunit\/phpunit-mock-objects": "^4.0",
        "sebastian\/comparator": "^2.0",
        "sebastian\/diff": "^1.2",
        "sebastian\/environment": "^3.0.1",
        "sebastian\/exporter": "^3.1",
        "sebastian\/global-state": "^1.1 || ^2.0",
        "sebastian\/object-enumerator": "^3.0.2",
        "sebastian\/resource-operations": "^1.0",
        "sebastian\/version": "^2.0"
    },
    "devDependencies": [],
    "version": [],
    "language": "php",
    "type": "library",
    "page": ""
}
```
The informations have been recuperated which the read of the files package.json or composer.json check, if the code is available on npm or packagist, and travis.
## Inspiration
Learnin from PHP [psr-3](http://www.php-fig.org/psr/psr-3/)

## Authors

Yo69008
