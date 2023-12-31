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

use ReflectionClass;
use ReflectionException;
use TextControl\ReportingCloud\ReportingCloud;

/**
 * Trait DocumentDividerTrait
 */
trait AssertDocumentDividerTrait
{
    use AssertOneOfTrait;
    use ValueToStringTrait;

    /**
     * Check value is a valid document divider
     */
    public static function assertDocumentDivider(int $value, string $message = ''): void
    {
        $haystack = self::getDocumentDividers();
        $format   = '' === $message ? '%1$s contains an unsupported document divider' : $message;
        $message  = sprintf($format, self::valueToString($value));

        self::assertOneOf($value, $haystack, $message);
    }

    /**
     * Return document dividers array
     */
    private static function getDocumentDividers(): array
    {
        $constants = [];

        try {
            $reportingCloud  = new ReportingCloud();
            $reflectionClass = new ReflectionClass($reportingCloud);
            $constants       = $reflectionClass->getConstants();
            unset($reportingCloud);
        } catch (ReflectionException) {
        }

        $array = array_filter(
            $constants,
            static fn(string $constantKey): bool => str_starts_with($constantKey, 'DOCUMENT_DIVIDER_'),
            ARRAY_FILTER_USE_KEY
        );

        return array_values($array);
    }
}
