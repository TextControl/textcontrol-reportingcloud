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
use TextControl\ReportingCloud\ReportingCloud;

/**
 * Trait AssertTemplateFormatTestTrait
 *
 * @package TextControlTest\ReportingCloud
 * @author  Jonathan Maron (@JonathanMaron)
 */
trait AssertTemplateFormatTestTrait
{
    // <editor-fold desc="Abstract methods">

    /**
     * @param mixed  $condition
     * @param string $message
     */
    abstract public static function assertTrue($condition, string $message = ''): void;

    /**
     * @param string $exception
     */
    abstract public function expectException(string $exception): void;

    /**
     * @param string $message
     */
    abstract public function expectExceptionMessage(string $message): void;

    // </editor-fold>

    public function testAssertTemplateFormat(): void
    {
        $fileFormat   = ReportingCloud::FILE_FORMAT_DOC;
        $fileFormatLc = strtolower($fileFormat);

        Assert::assertTemplateFormat($fileFormat);
        Assert::assertTemplateFormat($fileFormatLc);

        self::assertTrue(true);
    }

    public function testAssertTemplateFormatInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"xxx" contains an unsupported template format file extension');

        Assert::assertTemplateFormat('xxx');
    }

    public function testAssertTemplateFormatInvalidWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message ("XXX")');

        Assert::assertTemplateFormat('XXX', 'Custom error message (%1$s)');
    }
}
