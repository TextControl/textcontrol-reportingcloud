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
use TextControl\ReportingCloud\PropertyMap\AccountSettings as PropertyMap;

class AccountSettingsTest extends TestCase
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
            'createdDocuments'        => 'created_documents',
            'maxDocuments'            => 'max_documents',
            'maxProofingTransactions' => 'max_proofing_transactions',
            'maxTemplates'            => 'max_templates',
            'proofingTransactions'    => 'proofing_transactions',
            'serialNumber'            => 'serial_number',
            'uploadedTemplates'       => 'uploaded_templates',
            'validUntil'              => 'valid_until',
        ];

        self::assertSame($expected, $this->propertyMap->getMap());
    }
}
