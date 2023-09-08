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

namespace TextControlTest\ReportingCloud;

use TextControl\ReportingCloud\ReportingCloud;
use TextControl\ReportingCloud\Stdlib\ConsoleUtils;
use TextControl\ReportingCloud\Stdlib\Path;

abstract class AbstractReportingCloudTestCase extends \PHPUnit\Framework\TestCase
{
    protected ReportingCloud $reportingCloud;

    // <editor-fold desc="Scaffolding">
    protected function setUp(): void
    {
        $apiKey = ConsoleUtils::apiKey();
        self::assertNotEmpty($apiKey);
        $options = [
            'api_key' => $apiKey,
        ];
        $this->reportingCloud = new ReportingCloud($options);
    }

    protected function tearDown(): void
    {
        unset($this->reportingCloud);
    }

    protected function getTestTemplateFilename(): string
    {
        return sprintf('%s/test_template.tx', Path::resource());
    }

    protected function getTestDocumentFilename(): string
    {
        return sprintf('%s/test_document.docx', Path::resource());
    }

    protected function getTestDocumentTrackedChangesFilename(): string
    {
        return sprintf('%s/tracked_changes.docx', Path::resource());
    }

    protected function getTestTemplateFindAndReplaceFilename(): string
    {
        return sprintf('%s/test_find_and_replace.tx', Path::resource());
    }

    protected function getTempDocumentFilename(): string
    {
        $format = '%s/test_document_%d.docx';
        return sprintf($format, $this->getTempPath(), random_int(0, PHP_INT_MAX));
    }

    protected function getTempTemplateFilename(): string
    {
        $format = '%s/test_template_%d.tx';
        return sprintf($format, $this->getTempPath(), random_int(0, PHP_INT_MAX));
    }

    /**
     * @return array<int, array<string, array<int, array<string, float|int|string>>|float|string>>
     */
    protected function getTestTemplateMergeData(): array
    {
        $ret = [[
            'yourcompany_companyname' => 'Text Control, LLC',
            'yourcompany_zip' => '28226',
            'yourcompany_city' => 'Charlotte',
            'yourcompany_street' => '6926 Shannon Willow Rd, Suite 400',
            'yourcompany_phone' => '704 544 7445',
            'yourcompany_fax' => '704-542-0936',
            'yourcompany_url' => 'www.textcontrol.com',
            'yourcompany_email' => 'sales@textcontrol.com',
            'invoice_no' => '778723',
            'billto_name' => 'Joey Montana',
            'billto_companyname' => 'Montana, LLC',
            'billto_customerid' => '123',
            'billto_zip' => '27878',
            'billto_city' => 'Charlotte',
            'billto_street' => '1 Washington Dr',
            'billto_phone' => '887 267 3356',
            'payment_due' => '20/1/2016',
            'payment_terms' => 'NET 30',
            'salesperson_name' => 'Mark Frontier',
            'delivery_date' => '20/1/2016',
            'delivery_method' => 'Ground',
            'delivery_method_terms' => 'NET 30',
            'recipient_name' => 'Joey Montana',
            'recipient_companyname' => 'Montana, LLC',
            'recipient_zip' => '27878',
            'recipient_city' => 'Charlotte',
            'recipient_street' => '1 Washington Dr',
            'recipient_phone' => '887 267 3356',
            'total_discount' => 532.6,
            'total_sub' => 7673.4,
            'total_tax' => 537.138,
            'total' => 8210.538,
            'item' => [[
                'qty' => 1,
                'item_no' => 1,
                'item_description' => 'Item description 1',
                'item_unitprice' => 2663,
                'item_discount' => 20,
                'item_total' => 2130.4,
            ], [
                'qty' => 1,
                'item_no' => 2,
                'item_description' => 'Item description 2',
                'item_unitprice' => 5543,
                'item_discount' => 0,
                'item_total' => 5543,
            ]],
        ]];
        // copy data 4 times
        // total record sets = 5
        for ($i = 0; 4 > $i; ++$i) {
            $ret[] = $ret[0];
        }
        return $ret;
    }

    /**
     * @return array<string, string>
     */
    protected function getTestTemplateFindAndReplaceData(): array
    {
        return [
            '%%FIELD1%%' => 'hello field 1',
            '%%FIELD2%%' => 'hello field 2',
        ];
    }

    /**
     * @return array<string, int|string>
     */
    protected function getTestDocumentSettings(): array
    {
        return [
            'author' => 'James Henry Trotter',
            'creation_date' => time(),
            'creator_application' => 'An awesome creator',
            'document_subject' => 'The Old Green Grasshopper',
            'document_title' => 'James and the Giant Peach',
            'last_modification_date' => time(),
            'user_password' => '123456789',
        ];
    }

    /**
     * @return array<string, bool|int|string>
     */
    protected function getTestMergeSettings(): array
    {
        return [
            'creation_date' => time(),
            'last_modification_date' => time(),
            'remove_empty_blocks' => true,
            'remove_empty_fields' => true,
            'remove_empty_images' => true,
            'remove_trailing_whitespace' => true,
            'author' => 'James Henry Trotter',
            'creator_application' => 'The Giant Peach',
            'document_subject' => 'The Old Green Grasshopper',
            'document_title' => 'James and the Giant Peach',
            'user_password' => '123456789',
        ];
    }

    protected function deleteAllApiKeys(): void
    {
        $apiKeys = $this->reportingCloud->getApiKeys();
        foreach ($apiKeys as $apiKey) {
            if ($apiKey['key'] === ConsoleUtils::apiKey()) {
                continue;
            }
            self::assertArrayHasKey('key', $apiKey);
            self::assertArrayHasKey('active', $apiKey);
            assert(is_string($apiKey['key']));
            $this->reportingCloud->deleteApiKey($apiKey['key']);
        }
        $apiKeys = $this->reportingCloud->getApiKeys();
        self::assertTrue(1 === count($apiKeys));
        self::assertArrayHasKey(0, $apiKeys);
        self::assertArrayHasKey('key', $apiKeys[0]);
        self::assertArrayHasKey('active', $apiKeys[0]);
        self::assertEquals(ConsoleUtils::apiKey(), $apiKeys[0]['key']);
        self::assertTrue($apiKeys[0]['active']);
    }

    // </editor-fold>
    // <editor-fold desc="Helpers">
    private function getTempPath(): string
    {
        return sys_get_temp_dir();
    }
    // </editor-fold>
}
