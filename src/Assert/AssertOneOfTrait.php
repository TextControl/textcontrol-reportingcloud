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
 * Trait AssertOneOfTrait
 */
trait AssertOneOfTrait
{
    use ValueToStringTrait;

    /**
     * Check value is in values
     */
    public static function assertOneOf(mixed $value, array $values, string $message = ''): void
    {
        if (!in_array($value, $values, true)) {
            $array = [];
            foreach ($values as $key => $record) {
                $array[$key] = self::valueToString($record);
            }
            $valuesString = implode(', ', $array);
            $format       = '' === $message ? 'Expected one of %2$s. Got %1$s' : $message;
            $message      = sprintf($format, self::valueToString($value), $valuesString);
            throw new InvalidArgumentException($message);
        }
    }
}
