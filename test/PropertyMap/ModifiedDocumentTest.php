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

namespace TextControlTest\ReportingCloud\PropertyMap;

use PHPUnit\Framework\TestCase;
use TextControl\ReportingCloud\PropertyMap\ModifiedDocument as PropertyMap;

class ModifiedDocumentTest extends TestCase
{
    protected PropertyMap $propertyMap;

    protected function setUp(): void
    {
        $this->propertyMap = new PropertyMap();
    }

    protected function tearDown(): void
    {
        unset($this->propertyMap);
    }

    public function testValid(): void
    {
        $expected = [
            'document' => 'document',
            'removed'  => 'removed',
        ];

        self::assertSame($expected, $this->propertyMap->getMap());
    }
}
