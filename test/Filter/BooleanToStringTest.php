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

use PHPUnit\Framework\TestCase;
use TextControl\ReportingCloud\Filter\Filter;

class BooleanToStringTest extends TestCase
{
    public function testTrueString(): void
    {
        self::assertSame('true', Filter::filterBooleanToString(true));
    }

    public function testFalseString(): void
    {
        self::assertSame('false', Filter::filterBooleanToString(false));
    }
}
