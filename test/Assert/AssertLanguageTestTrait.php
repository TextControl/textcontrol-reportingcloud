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
 * Trait AssertLanguageTestTrait
 */
trait AssertLanguageTestTrait
{
    // <editor-fold desc="Abstract methods">
    abstract public static function assertTrue(mixed $condition, string $message = ''): void;

    abstract public function expectException(string $exception): void;

    abstract public function expectExceptionMessage(string $message): void;

    // </editor-fold>

    public function testAssertLanguage(): void
    {
        Assert::assertLanguage('de_CH_frami.dic');
        Assert::assertLanguage('pt_BR.dic');
        Assert::assertLanguage('nb_NO.dic');

        self::assertTrue(true);
    }

    public function testAssertLanguageInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"pt_BR" contains an unsupported language');

        Assert::assertLanguage('pt_BR');
    }

    public function testAssertLanguageInvalidWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom error message ("xx_XX")');

        Assert::assertLanguage('xx_XX', 'Custom error message (%1$s)');
    }
}
