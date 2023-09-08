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
 * TemplateList property map
 */
class TemplateList extends AbstractPropertyMap
{
    /**
     * Set the property map of TemplateList
     */
    public function __construct()
    {
        $map = [
            'modified'     => 'modified',
            'size'         => 'size',
            'templateName' => 'template_name',
        ];

        $this->setMap($map);
    }
}