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
use TextControl\ReportingCloud\PropertyMap\ApiKey as PropertyMap;

/**
 * Class ApiKeyTest
 *
 * @package TextControlTest\ReportingCloud
 * @author  Jonathan Maron (@JonathanMaron)
 */
class ApiKeyTest extends TestCase
{
    protected PropertyMap $propertyMap;

    public function setUp(): void
    {
        $this->propertyMap = new PropertyMap();
    }

    public function tearDown(): void
    {
        unset($this->propertyMap);
    }

    public function testValid(): void
    {
        $expected = [
            'active' => 'active',
            'key'    => 'key',
        ];

        self::assertSame($expected, $this->propertyMap->getMap());
    }
}
