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

namespace TextControlTest\ReportingCloud\PropertyMap;

use PHPUnit\Framework\TestCase;
use TextControl\ReportingCloud\PropertyMap\TemplateInfo as PropertyMap;

class TemplateInfoTest extends TestCase
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
            'dateTimeFormat'         => 'date_time_format',
            'mergeBlocks'            => 'merge_blocks',
            'mergeFields'            => 'merge_fields',
            'name'                   => 'name',
            'numericFormat'          => 'numeric_format',
            'preserveFormatting'     => 'preserve_formatting',
            'templateName'           => 'template_name',
            'text'                   => 'text',
            'textAfter'              => 'text_after',
            'textBefore'             => 'text_before',
            'userDocumentProperties' => 'user_document_properties',
        ];

        self::assertSame($expected, $this->propertyMap->getMap());
    }
}
