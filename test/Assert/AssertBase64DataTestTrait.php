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
 * Trait AssertBase64DataTestTrait
 */
trait AssertBase64DataTestTrait
{
    // <editor-fold desc="Abstract methods">
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    // </editor-fold>

    public function testAssertBase64Data(): void
    {
        $value = base64_encode('ReportingCloud rocks!');
        Assert::assertBase64Data($value);

        self::assertTrue(true);
    }

    public function testAssertBase64DataInvalidCharacters(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"#*abc" must be base64 encoded');

        Assert::assertBase64Data('#*abc');
    }

    public function testAssertBase64DataInvalidDigits(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"-1" must be base64 encoded');

        Assert::assertBase64Data('-1');
    }

    public function testAssertBase64DataInvalidBrackets(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"[]" must be base64 encoded');

        Assert::assertBase64Data('[]');
    }

    public function testAssertBase64DataWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message ("**********")');

        Assert::assertBase64Data('**********', 'Custom error message (%1$s)');
    }
}
