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
 * @copyright © 2023 Text Control GmbH
 */

namespace TextControl\ReportingCloud\Stdlib;

class StringUtils extends AbstractStdlib
{
    /**
     * Return true, if needle is at the beginning of haystack
     */
    public static function startsWith(string $haystack, string $needle): bool
    {
        // Source: https://git.io/JnWmc

        return str_starts_with($haystack, $needle);
    }

    /**
     * Return true, if needle is at the end of haystack
     */
    public static function endsWith(string $haystack, string $needle): bool
    {
        // Source: https://git.io/JnWml

        return '' === $needle || ('' !== $haystack && str_ends_with($haystack, $needle));
    }
}
