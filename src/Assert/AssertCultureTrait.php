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
use TextControl\ReportingCloud\Stdlib\Path;

/**
 * Trait AssertLanguageTrait
 *
 * @package TextControl\ReportingCloud
 * @author  Jonathan Maron (@JonathanMaron)
 */
trait AssertCultureTrait
{
    use ValueToStringTrait;
    use AssertOneOfTrait;

    /**
     * Check value is a valid culture
     *
     * @param string $value
     * @param string $message
     *
     * @return void
     * @throws InvalidArgumentException
     */
    public static function assertCulture(string $value, string $message = ''): void
    {
        $haystack = self::getCultures();
        $format   = 0 === strlen($message) ? '%1$s contains an unsupported culture' : $message;
        $message  = sprintf($format, self::valueToString($value));

        self::assertOneOf($value, $haystack, $message);
    }

    /**
     * Return the filename, containing cultures array
     *
     * @return string
     */
    public static function getCulturesFilename(): string
    {
        return sprintf('%1$s/cultures.php', Path::data());
    }

    /**
     * Return cultures array
     *
     * @return array
     */
    private static function getCultures(): array
    {
        $filename = self::getCulturesFilename();

        return (array) include $filename;
    }
}
