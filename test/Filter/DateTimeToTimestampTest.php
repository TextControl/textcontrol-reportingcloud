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

namespace TextControlTest\ReportingCloud\Filter;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use TextControl\ReportingCloud\Filter\Filter;
use TextControlTest\ReportingCloud\Filter\TestAsset\DefaultProvider;

class DateTimeToTimestampTest extends TestCase
{
    protected string $defaultTimezone;

    protected function setUp(): void
    {
        $this->defaultTimezone = date_default_timezone_get();
    }

    protected function tearDown(): void
    {
        date_default_timezone_set($this->defaultTimezone);
        unset($this->defaultTimezone);
    }

    #[DataProviderExternal(DefaultProvider::class, 'defaultProvider')]
    public function testValid(string $timeZone, string $dateTimeString, int $timestamp): void
    {
        $identifiers = timezone_identifiers_list();
        if (in_array($timeZone, $identifiers, true)) {
            date_default_timezone_set($timeZone);
            self::assertSame($timestamp, Filter::filterDateTimeToTimestamp($dateTimeString));
        }
    }
}
