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
 * @copyright © 2023 Text Control GmbH
 */

namespace TextControl\ReportingCloud\Assert;

use TextControl\ReportingCloud\Exception\InvalidArgumentException;

/**
 * Trait AssertBase64DataTrait
 */
trait AssertBase64DataTrait
{
    use ValueToStringTrait;

    /**
     * Check value is valid base64 encoded data
     */
    public static function assertBase64Data(string $value, string $message = ''): void
    {
        $binaryData = base64_decode($value, true);
        if (is_bool($binaryData) || '' === $binaryData) {
            $format  = '' === $message ? '%1$s must be base64 encoded' : $message;
            $message = sprintf($format, self::valueToString($value));
            throw new InvalidArgumentException($message);
        }
    }
}
