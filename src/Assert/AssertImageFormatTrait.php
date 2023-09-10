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
 * Trait AssertImageFormatTrait
 */
trait AssertImageFormatTrait
{
    use AssertOneOfTrait;
    use ValueToStringTrait;

    /**
     * Check value is valid image format extension
     */
    public static function assertImageFormat(string $value, string $message = ''): void
    {
        $ucValue = strtoupper($value);
        $format  = '' === $message ? '%1$s contains an unsupported image format file extension' : $message;
        $message = sprintf($format, self::valueToString($value));

        self::assertOneOf($ucValue, ReportingCloud::FILE_FORMATS_IMAGE, $message);
    }
}
