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

use DateTime;
use DateTimeZone;
use Exception;
use TextControl\ReportingCloud\Exception\InvalidArgumentException;
use TextControl\ReportingCloud\ReportingCloud;

/**
 * Trait AssertDateTimeTrait
 */
trait AssertDateTimeTrait
{
    use ValueToStringTrait;

    /**
     * Check value is a valid DateTime string
     */
    public static function assertDateTime(string $value, string $message = ''): void
    {
        $timeZone   = ReportingCloud::DEFAULT_TIME_ZONE;
        $dateFormat = ReportingCloud::DEFAULT_DATE_FORMAT;

        if (self::getDateTimeLength() !== strlen($value)) {
            $format  = '' === $message ? '%1$s has an invalid number of characters in it' : $message;
            $message = sprintf($format, self::valueToString($value));
            throw new InvalidArgumentException($message);
        }

        $dateTimeZone = new DateTimeZone($timeZone);

        try {
            $dateTime = DateTime::createFromFormat($dateFormat, $value, $dateTimeZone);
            if ($dateTime instanceof DateTime) {
                if (0 !== $dateTime->getOffset()) {
                    $format  = '' === $message ? '%1$s has an invalid offset' : $message;
                    $message = sprintf($format, self::valueToString($value));
                    throw new InvalidArgumentException($message);
                }
            } else {
                $format  = '' === $message ? '%1$s is syntactically invalid' : $message;
                $message = sprintf($format, self::valueToString($value));
                throw new InvalidArgumentException($message);
            }
        } catch (Exception $exception) {
            // @phpstan-ignore-next-line
            $format  = '' === $message ? 'Internal error validating %1$s - %2$s' : $message;
            $message = sprintf($format, self::valueToString($value), self::valueToString($exception->getMessage()));
            throw new InvalidArgumentException($message);
        }
    }

    /**
     * Get the length of the required dateTime string
     */
    private static function getDateTimeLength(): int
    {
        $ret = 0;

        $timeZone   = ReportingCloud::DEFAULT_TIME_ZONE;
        $dateFormat = ReportingCloud::DEFAULT_DATE_FORMAT;

        $dateTimeZone = new DateTimeZone($timeZone);

        try {
            $dateTime = new DateTime('now', $dateTimeZone);
            $ret      = strlen($dateTime->format($dateFormat));
            unset($dateTime);
            unset($dateTimeZone);
        } catch (Exception) {
            // continue;
        }

        return $ret;
    }
}
