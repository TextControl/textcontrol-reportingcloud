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
 * Trait AssertTemplateExtensionTestTrait
 */
trait AssertTemplateExtensionTestTrait
{
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    public function testAssertTemplateExtension(): void
    {
        Assert::assertTemplateExtension('./template.tx');
        Assert::assertTemplateExtension('./TEMPLATE.TX');

        Assert::assertTemplateExtension('../template.tx');
        Assert::assertTemplateExtension('../TEMPLATE.TX');

        Assert::assertTemplateExtension('/../template.tx');
        Assert::assertTemplateExtension('/../TEMPLATE.TX');

        Assert::assertTemplateExtension('/path/to/template.tx');
        Assert::assertTemplateExtension('/PATH/TO/TEMPLATE.TX');

        Assert::assertTemplateExtension('c:\path\to\template.tx');
        Assert::assertTemplateExtension('c:\PATH\TO\TEMPLATE.TX');

        Assert::assertTemplateExtension('.tx');
        Assert::assertTemplateExtension('.TX');

        Assert::assertTemplateExtension('1.tx');
        Assert::assertTemplateExtension('1.TX');

        Assert::assertTemplateExtension('a.tx');
        Assert::assertTemplateExtension('A.TX');

        // @phpstan-ignore-next-line
        self::assertTrue(true);
    }

    public function testAssertTemplateExtensionInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"template.xxx" contains an unsupported template format file extension');

        Assert::assertTemplateExtension('template.xxx');
    }

    public function testAssertTemplateExtensionInvalidWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message ("template.xxx")');

        Assert::assertTemplateExtension('template.xxx', 'Custom error message (%1$s)');
    }
}
