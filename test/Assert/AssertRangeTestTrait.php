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

namespace TextControlTest\ReportingCloud\Assert;

use TextControl\ReportingCloud\Assert\Assert;
use TextControl\ReportingCloud\Exception\InvalidArgumentException;

/**
 * Trait AssertRangeTraitTest
 */
trait AssertRangeTestTrait
{
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    public function testAssertRange(): void
    {
        Assert::assertRange(5, 1, 10);
        Assert::assertRange(1, 1, 10);
        Assert::assertRange(10, 1, 10);

        // @phpstan-ignore-next-line
        self::assertTrue(true);
    }

    public function testAssertRangeWithInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected a value between 1 and 10. Got: 11');

        Assert::assertRange(11, 1, 10);
    }
}
