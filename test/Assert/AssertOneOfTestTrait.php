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
 * Trait AssertOneOfTraitTest
 */
trait AssertOneOfTestTrait
{
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    public function testAssertOneOf(): void
    {
        Assert::assertOneOf('a', ['a', 'b', 'c']);
        Assert::assertOneOf(1, [1, 2, 3]);

        // @phpstan-ignore-next-line
        self::assertTrue(true);
    }

    public function testAssertOneOfWithInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected one of "a", "b", "c". Got "d"');

        Assert::assertOneOf('d', ['a', 'b', 'c']);
    }
}
