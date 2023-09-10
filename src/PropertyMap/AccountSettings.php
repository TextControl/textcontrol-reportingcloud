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

namespace TextControl\ReportingCloud\PropertyMap;

/**
 * AccountSettings property map
 */
class AccountSettings extends AbstractPropertyMap
{
    /**
     * Set the property map of AccountSettings
     */
    public function __construct()
    {
        $this->setMap([
            'createdDocuments'        => 'created_documents',
            'maxDocuments'            => 'max_documents',
            'maxProofingTransactions' => 'max_proofing_transactions',
            'maxTemplates'            => 'max_templates',
            'proofingTransactions'    => 'proofing_transactions',
            'serialNumber'            => 'serial_number',
            'uploadedTemplates'       => 'uploaded_templates',
            'validUntil'              => 'valid_until',
        ]);
    }
}
