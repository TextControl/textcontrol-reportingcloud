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
        $map = [
            'active' => 'active',
            'key'    => 'key',
        ];

        $this->setMap($map);
    }
}
