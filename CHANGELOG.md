![Logo](./resource/rc_logo_512.png)

# CHANGELOG

## dev-php81 (future 4.0.0)

* Removed PHP 7.4 support.
* Minor refactoring for PHP 8.1 compatibility.

## 3.0.0 - 2021-06-21

For a full description of changes, see [release-3.0.0.md](./doc/release-3.0.0.md).

* Added support for PHP 8.0.
* Upgraded minimum PHP requirement to 7.4.
* Added typed properties.
* Removed nullable type from public method parameters.
* Updated to [Guzzle 7.0](https://github.com/guzzle/guzzle).
* Updated to [PHPUnit 9.5](https://phpunit.readthedocs.io/en/9.5/).
* Removed class `StatusCode`.
* Added [ctw/ctw-http](https://packagist.org/packages/ctw/ctw-http) as a replacement for `StatusCode`. 
* Switched to [PHPStan](https://github.com/phpstan/phpstan) for static analysis, with [strict rules](https://github.com/phpstan/phpstan-strict-rules).
* Deprecated username and password authentication, in favor of API key authentication.

## 2.6.2 - 2020-10-28

* Improved [Composer 2.0](https://blog.packagist.com/composer-2-0-is-now-available/) compatibility.
* Fixed PSR-4 autoloading issue in tests.

## 2.6.1 - 2020-01-07

* Improved documentation for [Laminas](https://getlaminas.org/) migration. 

## 2.6.0 - 2019-12-18

* Added support for PHP 7.4.
* Improved code quality, using static analysis.
* Updated to PHPUnit 8.

## 2.5.0 - 2019-09-02

* Added support for [Tracked Changes](https://www.textcontrol.com/blog/2019/08/09/).

## 2.4.0 - 2019-04-30

* Added ability to set base URI of ReportingCloud service via environment variable or PHP constant.
* Added `TextControl\ReportingCloud\Assert\Assert::assertBaseUri` to validate base URI.
* Removed deprecated demos is  `/demo/instantiation.php`.

## 2.3.0 - 2019-03-11

* Removed `Webmozart\Assert` dependency.

## 2.2.0 - 2019-03-06

* Implemented [end-point](https://www.textcontrol.com/blog/2019/03/07/) 
    * `/v1/document/thumbnails`
* Added `/demo/get-document-thumbnails.php` to exemplify `getDocumentThumbnails(string $documentFilename, int $zoomFactor, int $fromPage, int $toPage,string $imageFormat)`.    
* Abstracted file utilities to `TextControl\ReportingCloud\Stdlib\FileUtils`.

## 2.1.0 - 2019-02-25

* Added support for [TXT return file format](https://www.textcontrol.com/blog/2019/02/20/).
* Added class constants for file formats to `TextControl\ReportingCloud\ReportingCloud`.
* Added return types to all unit tests.
* Added `bin/build-gh-pages.sh` to build GitHub Pages site (API documentation and unit test coverage).
* Re-organized bootstrapping of console scripts.
* Improved code quality with static analysis ([phpstan](https://github.com/phpstan/phpstan), [psalm](https://github.com/vimeo/psalm/) and [phan](https://github.com/phan/phan)).

## 2.0.2 - 2019-01-03

* Fixed return value of `downloadTemplate($templateName)` to binary data - it was base64 encoded data; it should have been binary data.
* Added generator parameter to `Stdlib\ArrayUtils::varExportToFile`.
* Split up `/resources` and `/data` contents.
* Split up unit tests into similarly named Traits as `TextControl\ReportingCloud\ReportingCloud`.
* Added strict typing to all unit tests.
* Removed deprecated function calls in unit tests.

## 2.0.1 - 2018-12-20

* Minor refactoring and code formatting.

## 2.0.0 - 2018-12-19

For a full description of changes, see [release-2.0.0.md](./doc/release-2.0.0.md).

* Removed all Zend Framework 3 dependencies.
* Set the minimum PHP version to 7.1.
* Added strict typing to all files.
* Upgraded to PHPUnit 7.5.
* Abstracted (magic number) HTTP codes to `TextControl\ReportingCloud\StatusCode\StatusCode`.
* Abstracted string utilities to `TextControl\ReportingCloud\Stdlib\StringUtils`.
* Abstracted array utilities to `TextControl\ReportingCloud\Stdlib\ArrayUtils`.
* Abstracted console utilities to `TextControl\ReportingCloud\Stdlib\ConsoleUtils`.
* Tested in PHP 7.1, PHP 7.2 and PHP 7.3.

## 1.9.1 - 2018-10-23

* Updated documentation.

## 1.9.0 - 2018-10-23

* Implemented [end-point](https://www.textcontrol.com/blog/2018/10/01/new-reportingcloud-endpoint-appending-documents/):
    * `/v1/document/append`
* Added `/demo/append-document-basic.php` and `/demo/append-document-advanced.php` to exemplify `appendDocument($documentsData, $returnFormat, $documentSettings)`.
* Switched from username and password authentication to API key authentication in all demos and tests. The former authentication is deprecated and will be removed in a future version.
* Updated `/bin/build-cultures.php` following change to backend.

## 1.8.0 - 2018-08-02

* Added `user_document_properties` key (containing an array) to the return value of `getTemplateInfo($templateName)`, following the addition of an [extension](https://www.textcontrol.com/blog/2018/07/27/) on the backend.
* Updated `/demo/get-template-info.php` to exemplify `user_document_properties` key and array.

## 1.7.0 - 2018-01-25

* Added method `uploadTemplateFromBase64($data, $templateName)` to upload templates stored in a string, in addition to on the filesystem.
* Added `Base64Data` validator to validate `$data` passed to `uploadTemplateFromBase64($data, $templateName)`.
* Refactored `uploadTemplate($templateFilename)` to use `uploadTemplateFromBase64($data, $templateName)`.

## 1.6.1 - 2018-01-19

* Updated phpunit configuration.
* Added PDF/A return format `PDFA` to `TextControl\ReportingCloud\Validator\ReturnFormat`.

## 1.6.0 - 2018-01-14

* Split `TextControl\ReportingCloud\ReportingCloud` into multiple Traits.
* Added `PHP_CodeSniffer` to ensure consistency in code formatting.
* Added Composer script `composer test` to run unit tests.
* Added Composer script `composer phpcs` to run `PHP_CodeSniffer`.
* Merged `media` directory to `data` directory.
* Implemented [end-points](https://www.textcontrol.com/blog/2017/12/29/):
    * `/v1/account/apikeys`
    * `/v1/account/apikey`
* Implemented [authorization header](https://www.textcontrol.com/blog/2017/12/29/) `ReportingCloud-APIKey`.
* Updated Scrutinizer configuration to run tests in multiple PHP versions.
* Updated copyright year to 2018.

## 1.5.2 - 2017-10-16

* Refactored `Culture` and `Language` validators, abstracting common logic.
* Refactored `/bin/buid-culture.php` and `/bin/buid-dictionaries.php`, abstracting common logic.

## 1.5.1 - 2017-10-15

* Deployed `Culture` validator.

## 1.5.0 - 2017-10-15

* Implemented the key [culture](https://www.textcontrol.com/blog/2017/10/13/) in `mergeSettings`.
* Restructured the `resources` directory.

## 1.4.0 - 2017-10-02

* Implemented [end-points](https://www.textcontrol.com/blog/2017/08/23/):
    * `/v1/proofing/check`
    * `/v1/proofing/availabledictionaries`
    * `/v1/proofing/suggestions`
* Updated `AccountSettings` property map with keys:
    * `proofing_transactions`
    * `max_proofing_transactions`
* Refactored `Validator` unit tests.
* Added script to download and build _available dictionaries_ resource file.

## 1.3.4 - 2017-08-22

* Implemented the `mergeSettings` option `merge_html`.
* Minor updates to DocBlock documentation.
* Improved code formatting quality.

## 1.3.3 - 2017-05-02

* Simplification of auto-loading for files in `/bin`, `/demo` and `/test`.

## 1.3.2 - 2017-05-02

* Unified auto-loading for files in `/bin`, `/demo` and `/test`.
* Updated and added documentation.

## 1.3.1 - 2017-04-05

* Updated and added documentation.
* Removed Travis Building. See `/doc/travis.md`.

## 1.3.0 - 2017-04-05

* Implemented end-point `/v1/fonts/list`.

## 1.2.0 - 2017-02-25

* Updated `zendframework/zend-servicemanager` to `^3.2`.
* Added an image merging `mergeDocument()` demo.
* Added script to `/bin` directory that reports on the environment in which it is running.
* Added a basic `mergeDocument()` demo.
* Renamed the advanced `mergeDocument()` demo.
* Added documentation.

## 1.1.0 - 2016-10-17

* Added new tests to check properties returned by `getTemplateInfo()` and `getAccountSettings()`.
* Minor refactoring of `StaticFilter` and `StaticValidator` components.
* Minor refactoring, mainly of array iterations.
* Added filter to convert boolean true and false to string 'true' and 'false' (required for compatibilty with backend).
* Implemented 'test' parameter with property `/test` and related setter and getter.
* Added unit tests for `findAndReplaceDocument()` method.
* Refactored `mergeDocument()` and `findAndReplaceDocument()` methods.
* Implemented end-point `/v1/document/findandreplace`.
* Set default `Content-Type` HTTP header.

## 1.0.12 - 2016-08-30

* Implemented end-point `/v1/templates/info`.

## 1.0.11 - 2016-08-16

* Removed non-essential development dependencies from `composer.json`.
* Set scrutinizer-ci to run tests and report on code coverage.

## 1.0.10 - 2016-07-20

* Moved orphaned helper functions (`reporting_cloud_*`) to helper class `TextControl\ReportingCloud\Stdlib\ConsoleUtils`.

## 1.0.9 - 2016-07-18

* Various minor code fixes following Scrutinizer and Coveralls integration.
* Added unit tests to test all return formats in `mergeDocument()` and `convertDocument()` methods.
* In unit tests migrated from `assertEquals()` to `assertSame()`.

## 1.0.8 - 2016-06-21

* Switched protocol from HTTP to HTTPS for all communication with the backend, now the backend supports it.
* Abstracted all parameter validation to `TextControl\ReportingCloud\Validator\StaticValidator`
* Made `TextControl\ReportingCloud\Validator` properties consistent.

## 1.0.7 - 2016-06-08

* Made `TextControl\ReportingCloud\Validator` properties consistent with those in `Zend\Validator`.
* Updated `composer.json` to be installable on PHP 7.0.7.
* Improved date/time conversion `Filter` components.
* Added empty `CONTRIBUTING.md` file.
* Documentation update.
* Switched from `dump()` to `var_dump()` in `/demo` directory, as `symfony/var-dumper` is a development dependency only.
* Abstracted all date/time conversion to their own Filter components.

## 1.0.6 - 2016-06-02

* Documentation fixes.
* Added validation of file extension to all occurrences of `$templateFilename` and `$documentFilename`.

## 1.0.5 - 2016-06-01

* Documentation fixes.

## 1.0.4 - 2016-06-01

* First public release.

## 1.0.3 - 2016-06-01

* Implemented end-point `/v1/templates/pagecount`.
* Implemented end-point `/v1/templates/exists`.

## 1.0.2 - 2016-05-30

* Added `size` key to templateList.

## 1.0.1 - 2016-05-29

* Private testing only.

## 0.9.0 - 2016-05-27

* Private testing only.
