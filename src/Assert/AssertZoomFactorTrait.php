<?php
declare(strict_types=1);

namespace TextControl\ReportingCloud\Assert;

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

/**
 * Trait AssertZoomFactorTrait
 */
trait AssertZoomFactorTrait
{
    use AssertRangeTrait;
    use ValueToStringTrait;

    /**
     * Minimum zoom factor
     */
    private static int $zoomFactorMin = 1;

    /**
     * Maximum zoom factor
     */
    private static int $zoomFactorMax = 400;

    /**
     * Check value is a valid zoom factor
     */
    public static function assertZoomFactor(int $value, string $message = ''): void
    {
        $format  = '' === $message ? 'Zoom factor (%1$s) must be in the range [%2$s..%3$s]' : $message;
        $message = sprintf(
            $format,
            self::valueToString($value),
            self::valueToString(self::$zoomFactorMin),
            self::valueToString(self::$zoomFactorMax)
        );

        self::assertRange($value, self::$zoomFactorMin, self::$zoomFactorMax, $message);
    }
}
