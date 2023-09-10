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

use TextControl\ReportingCloud\Exception\InvalidArgumentException;

/**
 * Trait AssertFilenameExistsTrait
 */
trait AssertFilenameExistsTrait
{
    use ValueToStringTrait;

    /**
     * Check filename exists and is readable
     */
    public static function assertFilenameExists(string $value, string $message = ''): void
    {
        if (!is_readable($value)) {
            $format  = '' === $message ? '%1$s does not exist or is not readable' : $message;
            $message = sprintf($format, self::valueToString($value));
            throw new InvalidArgumentException($message);
        }

        if (!is_file($value)) {
            $format  = '' === $message ? '%1$s is not a regular file' : $message;
            $message = sprintf($format, self::valueToString($value));
            throw new InvalidArgumentException($message);
        }
    }
}
