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

use TextControl\ReportingCloud\Stdlib\Path;

/**
 * Trait AssertLanguageTrait
 */
trait AssertCultureTrait
{
    use AssertOneOfTrait;
    use ValueToStringTrait;

    /**
     * Check value is a valid culture
     */
    public static function assertCulture(string $value, string $message = ''): void
    {
        $haystack = self::getCultures();
        $format   = '' === $message ? '%1$s contains an unsupported culture' : $message;
        $message  = sprintf($format, self::valueToString($value));

        self::assertOneOf($value, $haystack, $message);
    }

    /**
     * Return the filename, containing cultures array
     */
    public static function getCulturesFilename(): string
    {
        return sprintf('%1$s/cultures.php', Path::data());
    }

    /**
     * Return cultures array
     */
    private static function getCultures(): array
    {
        $filename = self::getCulturesFilename();

        return (array) include $filename;
    }
}
