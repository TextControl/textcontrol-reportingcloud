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
 * ApiKey property map
 */
class ApiKey extends AbstractPropertyMap
{
    /**
     * Set the property map of ApiKey
     */
    public function __construct()
    {
        $this->setMap([
            'active' => 'active',
            'key'    => 'key',
        ]);
    }
}
