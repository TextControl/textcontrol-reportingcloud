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

use TextControl\ReportingCloud\Stdlib\ArrayUtils;
use TextControlTest\ReportingCloud\AbstractReportingCloudTestCase;

class ArrayUtilsTest extends AbstractReportingCloudTestCase
{
    public function testVarExportToFile(): void
    {
        $filename = $this->getTestFilename();
        $array    = $this->getTestData();

        ArrayUtils::varExportToFile($filename, $array);

        self::assertEquals($array, include $filename);

        unlink($filename);
    }

    public function testVarExportToFileWithGenerator(): void
    {
        $filename = $this->getTestFilename();
        $array    = $this->getTestData();

        ArrayUtils::varExportToFile($filename, $array, 'My-Generator');

        $buffer = (string) file_get_contents($filename);

        self::assertStringContainsString('File generated by My-Generator.', $buffer);
        self::assertStringContainsString('Do not edit.', $buffer);

        unlink($filename);
    }

    /**
     * @return array<string, array<int, int>|string>
     */
    private function getTestData(): array
    {
        return [
            'a' => 'a',
            'b' => 'b',
            'c' => 'c',
            'd' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        ];
    }

    private function getTestFilename(): string
    {
        $filename = tempnam(sys_get_temp_dir(), hash('sha256', self::class));

        return (string) $filename;
    }
}
