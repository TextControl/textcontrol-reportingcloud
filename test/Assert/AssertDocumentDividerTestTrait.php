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
 * Trait AssertDocumentDividerTestTrait
 */
trait AssertDocumentDividerTestTrait
{
    // <editor-fold desc="Abstract methods">
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    // </editor-fold>

    public function testAssertDocumentDivider(): void
    {
        Assert::assertDocumentDivider(1);
        Assert::assertDocumentDivider(2);
        Assert::assertDocumentDivider(3);

        self::assertTrue(true);
    }

    public function testAssertDocumentDividerInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('10 contains an unsupported document divider');

        Assert::assertDocumentDivider(10);
    }

    public function testAssertDocumentDividerInvalidWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message (-10)');

        Assert::assertDocumentDivider(-10, 'Custom error message (%1$s)');
    }
}
