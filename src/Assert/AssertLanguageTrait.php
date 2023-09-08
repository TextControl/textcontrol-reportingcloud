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

use TextControl\ReportingCloud\Stdlib\Path;

/**
 * Trait AssertLanguageTrait
 */
trait AssertLanguageTrait
{
    use AssertOneOfTrait;
    use ValueToStringTrait;

    /**
     * Check value is a valid language
     */
    public static function assertLanguage(string $value, string $message = ''): void
    {
        $haystack = self::getDictionaries();
        $format   = '' === $message ? '%1$s contains an unsupported language' : $message;
        $message  = sprintf($format, self::valueToString($value));

        self::assertOneOf($value, $haystack, $message);
    }

    /**
     * Return the filename, containing languages aka dictionaries array
     */
    public static function getDictionariesFilename(): string
    {
        return sprintf('%1$s/dictionaries.php', Path::data());
    }

    /**
     * Return languages aka dictionaries array
     */
    private static function getDictionaries(): array
    {
        $filename = self::getDictionariesFilename();

        return (array) include $filename;
    }
}
