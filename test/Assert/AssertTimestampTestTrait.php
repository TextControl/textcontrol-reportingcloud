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

namespace TextControlTest\ReportingCloud\Assert;

use TextControl\ReportingCloud\Assert\Assert;
use TextControl\ReportingCloud\Exception\InvalidArgumentException;

/**
 * Trait AssertTimestampTestTrait
 */
trait AssertTimestampTestTrait
{
    // <editor-fold desc="Abstract methods">
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    // </editor-fold>

    public function testAssertTimestamp(): void
    {
        Assert::assertTimestamp(0);
        Assert::assertTimestamp(1);
        Assert::assertTimestamp(1000);
        Assert::assertTimestamp(10_000_000);
        Assert::assertTimestamp(PHP_INT_MAX);

        self::assertTrue(true);
    }

    public function testAssertTimestampInvalidTooSmall(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Timestamp (-1) must be in the range [0..9223372036854775807]');

        Assert::assertTimestamp(-1);
    }

    public function testAssertTimestampInvalidWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message (-50) - range: [0..9223372036854775807]');

        Assert::assertTimestamp(-50, 'Custom error message (%1$s) - range: [%2$s..%3$s]');
    }
}
