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
 * Trait AssertFilenameExistsTestTrait
 */
trait AssertFilenameExistsTestTrait
{
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    public function testAssertFilenameExists(): void
    {
        $filename = (string) tempnam(sys_get_temp_dir(), hash('sha256', self::class));
        touch($filename);
        Assert::assertFilenameExists($filename);
        unlink($filename);

        // @phpstan-ignore-next-line
        self::assertTrue(true);
    }

    public function testAssertFilenameExistsInvalidDoesContainAbsolutePathAndFile(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"/path/to/invalid/file" does not exist or is not readable');

        Assert::assertFilenameExists('/path/to/invalid/file');
    }

    public function testAssertFilenameExistsInvalidIsNotARegularFile(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"/tmp" is not a regular file');

        Assert::assertFilenameExists('/tmp');
    }

    public function testAssertFilenameExistsInvalidWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message ("/path/to/invalid/file")');

        Assert::assertFilenameExists('/path/to/invalid/file', 'Custom error message (%1$s)');
    }
}
