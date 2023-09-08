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

use TextControl\ReportingCloud\Exception\InvalidArgumentException;

/**
 * Trait AssertRemoveTrait
 */
trait AssertRemoveTrait
{
    use ValueToStringTrait;

    /**
     * Check value is a "remove_*" value
     */
    public static function assertRemove(mixed $value, string $message = ''): void
    {
        if (!is_bool($value)) {
            $format  = '' === $message ? 'Expected true or false. Got: %1$s' : $message;
            $message = sprintf($format, self::valueToString($value));
            throw new InvalidArgumentException($message);
        }
    }
}
