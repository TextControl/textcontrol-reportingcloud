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

namespace TextControlTest\ReportingCloud\Stdlib;

use TextControl\ReportingCloud\Stdlib\ConsoleUtils;
use TextControlTest\ReportingCloud\AbstractReportingCloudTestCase;

class ConsoleUtilsTest extends AbstractReportingCloudTestCase
{
    public function testCheckCredentials(): void
    {
        $key = ConsoleUtils::API_KEY;

        $oldValue = getenv($key);

        putenv(sprintf('%s=', $key));

        self::assertFalse(ConsoleUtils::checkCredentials());

        putenv(sprintf('%s=%s', $key, $oldValue));

        self::assertTrue(ConsoleUtils::checkCredentials());
    }

    public function testApiKeyFromEnv(): void
    {
        $key   = ConsoleUtils::API_KEY;
        $value = 'xxxxxxxxxxxxxxxxxxxx';

        $oldValue = getenv($key);

        putenv(sprintf('%s=%s', $key, $value));

        self::assertEquals(ConsoleUtils::apiKey(), $value);

        putenv(sprintf('%s=%s', $key, $oldValue));
    }

    public function testErrorMessage(): void
    {
        $errorMessage = ConsoleUtils::errorMessage();

        self::assertStringContainsString('Error: ReportingCloud API key not defined.', $errorMessage);

        self::assertStringContainsString(
            'For further assistance and customer service please refer to:',
            $errorMessage
        );
    }

    public function testDump(): void
    {
        ob_start();
        ConsoleUtils::dump([1, 2, 3, 4, 5]);
        $actual = (string) ob_get_clean();

        self::assertStringContainsString('array(5)', $actual);

        self::assertStringContainsString('[0]', $actual);
        self::assertStringContainsString('[1]', $actual);
        self::assertStringContainsString('[2]', $actual);
        self::assertStringContainsString('[3]', $actual);
        self::assertStringContainsString('[4]', $actual);

        self::assertStringContainsString('int(1)', $actual);
        self::assertStringContainsString('int(2)', $actual);
        self::assertStringContainsString('int(3)', $actual);
        self::assertStringContainsString('int(4)', $actual);
        self::assertStringContainsString('int(5)', $actual);
    }

    public function testWriteLineWith0Args(): void
    {
        $expected = '10 hello "world".' . PHP_EOL;

        ob_start();
        ConsoleUtils::writeLn('10 hello "world".');
        $actual = ob_get_clean();

        self::assertEquals($expected, $actual);
    }

    public function testWriteLineWith1Arg(): void
    {
        $expected = '10 x hello.' . PHP_EOL;

        ob_start();
        ConsoleUtils::writeLn('%d x hello.', [10]);
        $actual = ob_get_clean();

        self::assertEquals($expected, $actual);
    }

    public function testWriteLineWith2Args(): void
    {
        $expected = '10 x hello "world".' . PHP_EOL;

        ob_start();
        ConsoleUtils::writeLn('%d x hello "%s".', [10, 'world']);
        $actual = ob_get_clean();

        self::assertEquals($expected, $actual);
    }
}
