<?php
declare(strict_types=1);

/**
 * ReportingCloud PHP SDK
 *
 * PHP SDK for ReportingCloud Web API. Authored and supported by Text Control GmbH.
 *
 * @link      https://www.reporting.cloud to learn more about ReportingCloud
 * @link      https://tinyurl.com/vmbbh6kd for the canonical source repository
 * @license   https://tinyurl.com/3pc9am89
 * @copyright © 2023 Text Control GmbH
 */

namespace TextControl\ReportingCloud\Assert;

use TextControl\ReportingCloud\ReportingCloud;

/**
 * Trait AssertDocumentExtensionTrait
 */
trait AssertDocumentExtensionTrait
{
    use AssertOneOfTrait;
    use ValueToStringTrait;

    /**
     * Check value is a valid document format extension
     */
    public static function assertDocumentExtension(string $value, string $message = ''): void
    {
        $extension = pathinfo($value, PATHINFO_EXTENSION);
        $extension = strtoupper(/** @scrutinizer ignore-type */ $extension);

        $format  = '' === $message ? '%1$s contains an unsupported document format file extension' : $message;
        $message = sprintf($format, self::valueToString($value));

        self::assertOneOf($extension, ReportingCloud::FILE_FORMATS_DOCUMENT, $message);
    }
}
