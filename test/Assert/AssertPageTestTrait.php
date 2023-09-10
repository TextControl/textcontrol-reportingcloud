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

namespace TextControlTest\ReportingCloud\Assert;

use TextControl\ReportingCloud\Assert\Assert;
use TextControl\ReportingCloud\Exception\InvalidArgumentException;

/**
 * Trait AssertPageTestTrait
 */
trait AssertPageTestTrait
{
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    public function testAssertPage(): void
    {
        Assert::assertPage(1);
        Assert::assertPage(2);
        Assert::assertPage(PHP_INT_MAX);

        // @phpstan-ignore-next-line
        self::assertTrue(true);
    }

    public function testAssertPageInvalidTooSmall(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Page number (-1) must be in the range [1..9223372036854775807]');

        Assert::assertPage(-1);
    }

    public function testAssertPageInvalidWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message (-50) - range: [1..9223372036854775807]');

        Assert::assertPage(-50, 'Custom error message (%1$s) - range: [%2$s..%3$s]');
    }
}
