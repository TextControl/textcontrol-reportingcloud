![Logo](../resource/rc_logo_512.png)

# ReportingCloud PHP SDK 4.0

## Introduction

This is the fourth major release since the SDK was released in May 2016. It is a maintenance release. No new features have been added.

**This release adds support for PHP 8.1 and PHP 8.2 and improves the security and code quality of the SDK.

## Notable changes

### Added support for PHP 8.1 and PHP 8.2.

ReportingCloud PHP SDK 4.0 has been fully tested on PHP 8.1 and PHP 8.2.

### Namespace Change

The namespace of the component has been changed from `TextControl\ReportingCloud` to `TextControl\ReportingCloudSdk` to keep the SDK in sync with the other PHP components developed by Text Control GmbH.

## Removed class

The class `TxTextControl\ReportingCloud\Stdlib\StringUtils` has been removed as it duplicated functionality already provided by newer versions of PHP.