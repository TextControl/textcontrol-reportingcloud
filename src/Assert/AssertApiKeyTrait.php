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
 * Trait AssertApiKeyTrait
 */
trait AssertApiKeyTrait
{
    use AssertRangeTrait;
    use ValueToStringTrait;

    /**
     * Minimum length of API key
     */
    private static int $apiKeyMinLength = 20;

    /**
     * Maximum length of API key
     */
    private static int $apiKeyMaxLength = 45;

    /**
     * Check value is a syntactically valid API key
     */
    public static function assertApiKey(string $value, string $message = ''): void
    {
        $len = strlen($value);

        $format  = '' === $message ? 'Length of API key (%1$s) must be in the range [%2$s..%3$s]' : $message;
        $message = sprintf(
            $format,
            self::valueToString($value),
            self::valueToString(self::$apiKeyMinLength),
            self::valueToString(self::$apiKeyMaxLength)
        );

        self::assertRange($len, self::$apiKeyMinLength, self::$apiKeyMaxLength, $message);
    }
}
