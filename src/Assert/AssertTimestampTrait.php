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

/**
 * Trait AssertTimestampTrait
 */
trait AssertTimestampTrait
{
    use AssertRangeTrait;
    use ValueToStringTrait;

    /**
     * Minimum timestamp (EPOC)
     */
    private static int $timestampMin = 0;

    /**
     * Maximum timestamp (PHP_INT_MAX)
     */
    private static int $timestampMax = PHP_INT_MAX;

    /**
     * Check value is a valid timestamp
     */
    public static function assertTimestamp(int $value, string $message = ''): void
    {
        $format  = '' === $message ? 'Timestamp (%1$s) must be in the range [%2$s..%3$s]' : $message;
        $message = sprintf(
            $format,
            self::valueToString($value),
            self::valueToString(self::$timestampMin),
            self::valueToString(self::$timestampMax)
        );

        self::assertRange($value, self::$timestampMin, self::$timestampMax, $message);
    }
}
