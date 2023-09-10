![Logo](./resource/rc_logo_512.png)

# ReportingCloud PHP SDK

[![Build Status](https://scrutinizer-ci.com/g/TextControl/textcontrol-reportingcloud/badges/build.png?b=master)](https://scrutinizer-ci.com/g/TextControl/textcontrol-reportingcloud/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/TextControl/textcontrol-reportingcloud/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/TextControl/textcontrol-reportingcloud/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/textcontrol/textcontrol-reportingcloud/v/stable)](https://packagist.org/packages/textcontrol/textcontrol-reportingcloud)
[![composer.lock available](https://poser.pugx.org/textcontrol/textcontrol-reportingcloud/composerlock)](https://packagist.org/packages/textcontrol/textcontrol-reportingcloud)

This is the official PHP SDK for the ReportingCloud Web API. It is authored and supported by [Text Control GmbH](http://www.textcontrol.com).

Learn more about ReportingCloud at:

* [ReportingCloud website](https://www.reporting.cloud/)

* [ReportingCloud portal](https://portal.reporting.cloud/) - sign up here

* [ReportingCloud documentation](https://docs.reporting.cloud/)

Learn more about ReportingCloud PHP SDK at:

* [ReportingCloud PHP SDK GitHub page](https://github.com/TextControl/textcontrol-reportingcloud)

* [ReportingCloud PHP SDK Packagist page](https://packagist.org/packages/textcontrol/textcontrol-reportingcloud)

* [ReportingCloud PHP SDK API documentation](https://textcontrol.github.io/textcontrol-reportingcloud/docs-api/)

* [ReportingCloud PHP SDK support](https://docs.reporting.cloud/docs/chapter/introduction/support)

## Minimum Requirements

As of [ReportingCloud PHP SDK 4.0](/doc/release-4.0.0.md), the PHP SDK requires **PHP 8.1** or **PHP 8.2**.

All versions of PHP prior to 8.1 have reached [end-of-life](http://php.net/eol.php) and will no longer receive security updates. If your application is running in an older environment, it is highly recommended that you upgrade to a more recent version of PHP.

If you are unable or unwilling to upgrade your PHP installation, you may consider using ReportingCloud PHP SDK 3.0, which supports PHP 8.0, ReportingCloud PHP SDK 2.0, which supports PHP 7.1, or ReportingCloud PHP SDK 1.0, which supports PHP 5.6.

Please note that these versions are no longer maintained.

Alternatively, it is possible to use ReportingCloud by directly accessing the [Web API](https://docs.reporting.cloud/docs/endpoint). In this case, it is recommended to use the [curl](http://php.net/manual/en/book.curl.php) extension to make the API calls.

## Install Using Composer

Install ReportingCloud PHP SDK 4.0 in your project using [Composer](http://getcomposer.org):

```bash
composer require textcontrol/textcontrol-reportingcloud:^4.0
```

After installing, you just need to include Composer's autoloader:

```php
include_once 'vendor/autoload.php';
```

You are now ready to use the SDK.

## API Key for Demos and Unit Tests

ReportingCloud PHP SDK ships with a number of sample applications (see `/demo` directory) and phpunit tests (see `/test` directory). The scripts in each of these directories require an [API key](https://docs.reporting.cloud/docs/chapter/introduction/apikey) for ReportingCloud to run. To avoid accidentally exposing the API key via a public GIT repository, you need to specify it first. There are two ways to do this:

### Using PHP Constants:

```php
define('REPORTING_CLOUD_API_KEY', 'your-api-key');
```

### Using Environmental Variables (For Example in `.bashrc`)

```bash
export REPORTING_CLOUD_API_KEY='your-api-key'
```
Note that these instructions only apply to the demo scripts and phpunit tests. If you are using ReportingCloud in your application, set the [API key](https://docs.reporting.cloud/docs/chapter/introduction/apikey) in your constructor or by using the `setApiKey($apiKey)` methods. See `/demo/instantiation.php` for an example.

## Getting Started

The [PHP Quickstart Tutorial](https://docs.reporting.cloud/docs/chapter/quickstart/php) in the ReportingCloud [Documentation](https://docs.reporting.cloud/) is your starting point for using the ReportingCloud PHP SDK in your own applications.

In addition, ReportingCloud PHP SDK ships with a number of sample applications (see `/demo` directory). These well commented sample applications have been written to demonstrate all parts of ReportingCloud.

## Getting Support

The ReportingCloud PHP SDK is written and supported by Text Control GmbH, the manufacturer of the ReportingCloud Web API.

Despite our best efforts to create understandable documentation, demo applications, and unit tests, we understand that there are times when you may need technical assistance.

If you have a question about ReportingCloud or the PHP SDK, we want to help.

Please refer to the [Getting Support](https://docs.reporting.cloud/docs/chapter/introduction/support) section of the ReportingCloud [Documentation](https://docs.reporting.cloud/) to learn more about the support channels available to you.
