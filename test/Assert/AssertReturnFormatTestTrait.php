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
use TextControl\ReportingCloud\ReportingCloud;

/**
 * Trait AssertReturnFormatTestTrait
 */
trait AssertReturnFormatTestTrait
{
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    public function testAssertReturnFormat(): void
    {
        $fileFormat   = ReportingCloud::FILE_FORMAT_DOC;
        $fileFormatLc = strtolower($fileFormat);

        Assert::assertReturnFormat($fileFormat);
        Assert::assertReturnFormat($fileFormatLc);

        $fileFormat   = ReportingCloud::FILE_FORMAT_DOCX;
        $fileFormatLc = strtolower($fileFormat);

        Assert::assertReturnFormat($fileFormat);
        Assert::assertReturnFormat($fileFormatLc);

        $fileFormat   = ReportingCloud::FILE_FORMAT_HTML;
        $fileFormatLc = strtolower($fileFormat);

        Assert::assertReturnFormat($fileFormat);
        Assert::assertReturnFormat($fileFormatLc);

        $fileFormat   = ReportingCloud::FILE_FORMAT_PDF;
        $fileFormatLc = strtolower($fileFormat);

        Assert::assertReturnFormat($fileFormat);
        Assert::assertReturnFormat($fileFormatLc);

        $fileFormat   = ReportingCloud::FILE_FORMAT_PDFA;
        $fileFormatLc = strtolower($fileFormat);

        Assert::assertReturnFormat($fileFormat);
        Assert::assertReturnFormat($fileFormatLc);

        $fileFormat   = ReportingCloud::FILE_FORMAT_RTF;
        $fileFormatLc = strtolower($fileFormat);

        Assert::assertReturnFormat($fileFormat);
        Assert::assertReturnFormat($fileFormatLc);

        $fileFormat   = ReportingCloud::FILE_FORMAT_TX;
        $fileFormatLc = strtolower($fileFormat);

        Assert::assertReturnFormat($fileFormat);
        Assert::assertReturnFormat($fileFormatLc);

        $fileFormat   = ReportingCloud::FILE_FORMAT_TXT;
        $fileFormatLc = strtolower($fileFormat);

        Assert::assertReturnFormat($fileFormat);
        Assert::assertReturnFormat($fileFormatLc);

        // @phpstan-ignore-next-line
        self::assertTrue(true);
    }

    public function testAssertReturnFormatInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"xxx" contains an unsupported return format file extension');

        Assert::assertReturnFormat('xxx');
    }

    public function testAssertReturnFormatInvalidWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message ("XXX")');

        Assert::assertReturnFormat('XXX', 'Custom error message (%1$s)');
    }
}
