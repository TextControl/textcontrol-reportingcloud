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
use TextControl\ReportingCloud\ReportingCloud;

/**
 * Trait AssertImageFormatTestTrait
 */
trait AssertImageFormatTestTrait
{
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    public function testAssertImageFormat(): void
    {
        $fileFormat   = ReportingCloud::FILE_FORMAT_PNG;
        $fileFormatLc = strtolower($fileFormat);

        Assert::assertImageFormat($fileFormat);
        Assert::assertImageFormat($fileFormatLc);

        // @phpstan-ignore-next-line
        self::assertTrue(true);
    }

    public function testAssertImageFormatInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"xxx" contains an unsupported image format file extension');

        Assert::assertImageFormat('xxx');
    }

    public function testAssertImageFormatInvalidWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message ("SVG")');

        Assert::assertImageFormat('SVG', 'Custom error message (%1$s)');
    }
}
