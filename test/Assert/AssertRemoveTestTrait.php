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
 * Trait AssertRemoveTraitTest
 */
trait AssertRemoveTestTrait
{
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    public function testAssertRemove(): void
    {
        Assert::assertRemove(true);
        Assert::assertRemove(false);

        // @phpstan-ignore-next-line
        self::assertTrue(true);
    }

    public function testAssertRemoveWithInteger(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected true or false. Got: 1');

        Assert::assertRemove(1);

        // @phpstan-ignore-next-line
        self::assertTrue(true);
    }

    public function testAssertRemoveWithString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected true or false. Got: "a"');

        Assert::assertRemove('a');

        // @phpstan-ignore-next-line
        self::assertTrue(true);
    }

    public function testAssertRemoveWithArray(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected true or false. Got: array');

        Assert::assertRemove([1]);

        // @phpstan-ignore-next-line
        self::assertTrue(true);
    }
}
