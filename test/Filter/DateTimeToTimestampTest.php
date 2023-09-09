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
