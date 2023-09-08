<?php
declare(strict_types=1);

/**
 * ReportingCloud PHP SDK
 *
 * PHP SDK for ReportingCloud Web API. Authored and supported by Text Control GmbH.
 *
 * @link      https://www.reporting.cloud to learn more about ReportingCloud
 * @link      https://git.io/Jejj2 for the canonical source repository
 * @license   https://git.io/Jejjr
 * @copyright © 2022 Text Control GmbH
 */

namespace TextControl\ReportingCloud\Assert;

use TextControl\ReportingCloud\ReportingCloud;

/**
 * Trait AssertDocumentThumbnailExtensionTrait
 */
trait AssertDocumentThumbnailExtensionTrait
{
    use AssertOneOfTrait;
    use ValueToStringTrait;

    /**
     * Check value is a valid document thumbnail format extension
     *
     * This is a special case assert method that is used only by
     * TextControl\ReportingCloud\ReportingCloud::getDocumentThumbnails()
     * as this method additionally accepts files in XLSX format. No other methods do.
     */
    public static function assertDocumentThumbnailExtension(string $value, string $message = ''): void
    {
        $extension = pathinfo($value, PATHINFO_EXTENSION);
        $extension = strtoupper(/** @scrutinizer ignore-type */ $extension);

        $format  = '' === $message
            ? '%1$s contains an unsupported document thumbnail format file extension'
            : $message;
        $message = sprintf($format, self::valueToString($value));

        $fileFormats = [...ReportingCloud::FILE_FORMATS_DOCUMENT, ReportingCloud::FILE_FORMAT_XLSX];

        self::assertOneOf($extension, $fileFormats, $message);
    }
}
