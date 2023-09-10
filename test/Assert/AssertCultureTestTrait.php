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
 * Trait AssertCultureTestTrait
 */
trait AssertCultureTestTrait
{
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    public function testAssertCulture(): void
    {
        Assert::assertCulture('de-DE');
        Assert::assertCulture('fr-FR');
        Assert::assertCulture('en-US');

        // @phpstan-ignore-next-line
        self::assertTrue(true);
    }

    public function testAssertCultureInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"de-XX" contains an unsupported culture');

        Assert::assertCulture('de-XX');
    }

    public function testAssertCultureInvalidWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message ("xx-XX")');

        Assert::assertCulture('xx-XX', 'Custom error message (%1$s)');
    }
}
