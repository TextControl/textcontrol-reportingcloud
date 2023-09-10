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

/**
 * Trait AssertPageTrait
 */
trait AssertPageTrait
{
    use AssertRangeTrait;
    use ValueToStringTrait;

    /**
     * Minimum page number
     */
    private static int $pageMin = 1;

    /**
     * Maximum page number (PHP_INT_MAX)
     */
    private static int $pageMax = PHP_INT_MAX;

    /**
     * Check value is a valid page number
     */
    public static function assertPage(int $value, string $message = ''): void
    {
        $format  = '' === $message ? 'Page number (%1$s) must be in the range [%2$s..%3$s]' : $message;
        $message = sprintf(
            $format,
            self::valueToString($value),
            self::valueToString(self::$pageMin),
            self::valueToString(self::$pageMax)
        );

        self::assertRange($value, self::$pageMin, self::$pageMax, $message);
    }
}
