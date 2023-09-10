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
 * Trait AssertDocumentExtensionTestTrait
 */
trait AssertDocumentThumbnailExtensionTestTrait
{
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    public function testAssertDocumentThumbnailExtension(): void
    {
        Assert::assertDocumentThumbnailExtension('./document.xlsx');
        Assert::assertDocumentThumbnailExtension('./DOCUMENT.XLSX');

        Assert::assertDocumentThumbnailExtension('./document.doc');
        Assert::assertDocumentThumbnailExtension('./DOCUMENT.DOC');

        Assert::assertDocumentThumbnailExtension('../document.doc');
        Assert::assertDocumentThumbnailExtension('../DOCUMENT.DOC');

        Assert::assertDocumentThumbnailExtension('/../document.doc');
        Assert::assertDocumentThumbnailExtension('/../DOCUMENT.DOC');

        Assert::assertDocumentThumbnailExtension('/path/to/document.doc');
        Assert::assertDocumentThumbnailExtension('/PATH/TO/DOCUMENT.DOC');

        Assert::assertDocumentThumbnailExtension('c:\path\to\document.doc');
        Assert::assertDocumentThumbnailExtension('c:\PATH\TO\DOCUMENT.DOC');

        // @phpstan-ignore-next-line
        self::assertTrue(true);
    }

    public function testAssertDocumentThumbnailExtensionInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            '"document.xxx" contains an unsupported document thumbnail format file extension'
        );

        Assert::assertDocumentThumbnailExtension('document.xxx');
    }

    public function testAssertDocumentThumbnailExtensionInvalidWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message ("document.xxx")');

        Assert::assertDocumentThumbnailExtension('document.xxx', 'Custom error message (%1$s)');
    }
}
