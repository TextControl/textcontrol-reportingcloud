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
 * Trait AssertBase64DataTestTrait
 */
trait AssertBase64DataTestTrait
{
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    public function testAssertBase64Data(): void
    {
        $value = base64_encode('ReportingCloud rocks!');
        Assert::assertBase64Data($value);

        // @phpstan-ignore-next-line
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
