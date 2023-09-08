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
 * Trait ValueToStringTrait
 */
trait ValueToStringTrait
{
    /**
     * Convert value to string
     */
    protected static function valueToString(mixed $value): string
    {
        if (null === $value) {
            return 'null';
        }

        if (true === $value) {
            return 'true';
        }

        if (false === $value) {
            return 'false';
        }

        if (is_array($value)) {
            return 'array';
        }

        if (is_object($value)) {
            if (method_exists($value, '__toString')) {
                $format = '%1$s: %2$s';

                return sprintf($format, $value::class, self::valueToString($value->__toString()));
            }

            return $value::class;
        }

        if (is_resource($value)) {
            return 'resource';
        }

        if (is_string($value)) {
            $format = '"%1$s"';

            return sprintf($format, $value);
        }

        // @phpstan-ignore-next-line
        return (string) $value;
    }
}
