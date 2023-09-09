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

namespace TextControl\ReportingCloud\Assert;

use TextControl\ReportingCloud\Exception\InvalidArgumentException;
use TextControl\ReportingCloud\ReportingCloud;

/**
 * Trait AssertBaseUriTrait
 */
trait AssertBaseUriTrait
{
    use ValueToStringTrait;

    /**
     * Check value is a known base URI
     */
    public static function assertBaseUri(string $value, string $message = ''): void
    {
        $baseUri = ReportingCloud::DEFAULT_BASE_URI;

        $host1 = parse_url($baseUri, PHP_URL_HOST);
        $host2 = parse_url($value, PHP_URL_HOST);
        assert(is_string($host2));

        if (!str_ends_with($host2, $host1)) {
            $format  = '' === $message ? 'Expected base URI to end in %2$s. Got %1$s' : $message;
            $message = sprintf($format, self::valueToString($value), self::valueToString($host1));
            throw new InvalidArgumentException($message);
        }
    }
}
