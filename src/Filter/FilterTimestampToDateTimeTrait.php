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

namespace TextControl\ReportingCloud\Filter;

use DateTime;
use DateTimeZone;
use Exception;
use TextControl\ReportingCloud\Exception\InvalidArgumentException;
use TextControl\ReportingCloud\ReportingCloud;

/**
 * Trait FilterTimestampToDateTimeTrait
 */
trait FilterTimestampToDateTimeTrait
{
    /**
     * Convert a UNIX timestamp to the date/time format used by the backend (e.g. "2016-04-15T19:05:18+00:00").
     */
    public static function filterTimestampToDateTime(int $timestamp): string
    {
        $timeZone   = ReportingCloud::DEFAULT_TIME_ZONE;
        $dateFormat = ReportingCloud::DEFAULT_DATE_FORMAT;

        try {
            $dateTimeZone = new DateTimeZone($timeZone);
            $dateTime     = new DateTime();
            $dateTime->setTimestamp($timestamp);
            $dateTime->setTimezone($dateTimeZone);
            $ret = $dateTime->format($dateFormat);
        } catch (Exception $e) {
            throw new InvalidArgumentException($e->getMessage(), (int) $e->getCode());
        }

        return $ret;
    }
}
