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

use ReflectionClass;
use ReflectionException;
use TextControl\ReportingCloud\Exception\InvalidArgumentException;
use TextControl\ReportingCloud\ReportingCloud;
use TextControl\ReportingCloud\Stdlib\StringUtils;

/**
 * Trait DocumentDividerTrait
 *
 * @package TextControl\ReportingCloud
 * @author  Jonathan Maron (@JonathanMaron)
 */
trait AssertDocumentDividerTrait
{
    use ValueToStringTrait;
    use AssertOneOfTrait;

    /**
     * Check value is a valid document divider
     *
     * @param int    $value
     * @param string $message
     *
     * @return void
     * @throws InvalidArgumentException
     */
    public static function assertDocumentDivider(int $value, string $message = ''): void
    {
        $haystack = self::getDocumentDividers();
        $format   = 0 === strlen($message) ? '%1$s contains an unsupported document divider' : $message;
        $message  = sprintf($format, self::valueToString($value));

        self::assertOneOf($value, $haystack, $message);
    }

    /**
     * Return document dividers array
     *
     * @return array
     */
    private static function getDocumentDividers(): array
    {
        $constants = [];

        try {
            $reportingCloud  = new ReportingCloud();
            $reflectionClass = new ReflectionClass($reportingCloud);
            $constants       = $reflectionClass->getConstants();
            unset($reportingCloud);
        } catch (ReflectionException $e) {
        }

        $array = array_filter($constants, function (string $constantKey): bool {
            if (StringUtils::startsWith($constantKey, 'DOCUMENT_DIVIDER_')) {
                return true;
            }

            return false;
        }, ARRAY_FILTER_USE_KEY);

        $array = array_values($array);

        return $array;
    }
}
