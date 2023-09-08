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

namespace TextControlTest\ReportingCloud\Stdlib;

use TextControl\ReportingCloud\Stdlib\Path;
use TextControlTest\ReportingCloud\AbstractReportingCloudTestCase;

class PathTest extends AbstractReportingCloudTestCase
{
    public function testRoot(): void
    {
        $expected = dirname(__FILE__, 3);
        $actual   = Path::root();
        self::assertEquals($expected, $actual);
    }

    public function testOthers(): void
    {
        $paths = ['bin', 'data', 'demo', 'output', 'resource', 'test'];

        foreach ($paths as $path) {
            $expected = sprintf('%s/%s', Path::root(), $path);
            // @phpstan-ignore-next-line
            $actual   = Path::$path();
            self::assertEquals($expected, $actual);
        }
    }
}
