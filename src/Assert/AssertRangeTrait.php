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
 * Trait AssertRangeTrait
 *
 * @package TextControl\ReportingCloud
 * @author  Jonathan Maron (@JonathanMaron)
 */
trait AssertRangeTrait
{
    use ValueToStringTrait;

    /**
     * Check value is in range min..max
     *
     * @param int    $value
     * @param int    $min
     * @param int    $max
     * @param string $message
     *
     * @return void
     * @throws InvalidArgumentException
     */
    public static function assertRange(int $value, int $min, int $max, string $message = ''): void
    {
        if ($value < $min || $value > $max) {
            $format  = 0 === strlen($message) ? 'Expected a value between %2$s and %3$s. Got: %1$s' : $message;
            $message = sprintf(
                $format,
                self::valueToString($value),
                self::valueToString($min),
                self::valueToString($max)
            );
            throw new InvalidArgumentException($message);
        }
    }
}
