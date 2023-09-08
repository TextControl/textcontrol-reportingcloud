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
 * Trait AssertDocumentExtensionTestTrait
 */
trait AssertDocumentExtensionTestTrait
{
    // <editor-fold desc="Abstract methods">
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    // </editor-fold>

    public function testAssertDocumentExtension(): void
    {
        Assert::assertDocumentExtension('./document.doc');
        Assert::assertDocumentExtension('./DOCUMENT.DOC');

        Assert::assertDocumentExtension('../document.doc');
        Assert::assertDocumentExtension('../DOCUMENT.DOC');

        Assert::assertDocumentExtension('/../document.doc');
        Assert::assertDocumentExtension('/../DOCUMENT.DOC');

        Assert::assertDocumentExtension('/path/to/document.doc');
        Assert::assertDocumentExtension('/PATH/TO/DOCUMENT.DOC');

        Assert::assertDocumentExtension('c:\path\to\document.doc');
        Assert::assertDocumentExtension('c:\PATH\TO\DOCUMENT.DOC');

        self::assertTrue(true);
    }

    public function testAssertDocumentExtensionInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"document.xxx" contains an unsupported document format file extension');

        Assert::assertDocumentExtension('document.xxx');
    }

    public function testAssertDocumentExtensionInvalidWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message ("document.xxx")');

        Assert::assertDocumentExtension('document.xxx', 'Custom error message (%1$s)');
    }
}
