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
 * Trait AssertZoomFactorTestTrait
 */
trait AssertZoomFactorTestTrait
{
    // <editor-fold desc="Abstract methods">
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    // </editor-fold>

    public function testAssertZoomFactor(): void
    {
        Assert::assertZoomFactor(250);

        self::assertTrue(true);
    }

    public function testAssertZoomFactorInvalidTooSmall(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Zoom factor (-1) must be in the range [1..400]');

        Assert::assertZoomFactor(-1);
    }

    public function testAssertZoomFactorInvalidWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message (600) - range: [1..400]');

        Assert::assertZoomFactor(600, 'Custom error message (%1$s) - range: [%2$s..%3$s]');
    }
}
