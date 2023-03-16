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
 * ModifiedDocument property map
 *
 * @package TextControl\ReportingCloud
 * @author  Jonathan Maron (@JonathanMaron)
 */
class ModifiedDocument extends AbstractPropertyMap
{
    /**
     * Set the property map of ModifiedDocument
     */
    public function __construct()
    {
        $map = [
            'document' => 'document',
            'removed'  => 'removed',
        ];

        $this->setMap($map);
    }
}
