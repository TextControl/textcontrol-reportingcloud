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
 * Trait AssertBaseUriTestTrait
 */
trait AssertBaseUriTestTrait
{
    // <editor-fold desc="Abstract methods">
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    // </editor-fold>

    public function testAssertBaseUri(): void
    {
        Assert::assertBaseUri('https://phpunit-api.reporting.cloud');

        self::assertTrue(true);
    }

    public function testAssertBaseUriWithInvalidBaseUri(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Expected base URI to end in "api.reporting.cloud". Got "https://api.example.com"'
        );

        Assert::assertBaseUri('https://api.example.com');

        self::assertTrue(true);
    }

    public function testAssertBaseUriInvalidBaseUriKnownHost(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Expected base URI to end in "api.reporting.cloud". Got "https://api.reporting.cloud.de"'
        );

        Assert::assertBaseUri('https://api.reporting.cloud.de');

        self::assertTrue(true);
    }
}
