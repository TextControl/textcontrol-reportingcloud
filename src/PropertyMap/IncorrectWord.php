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

namespace TextControl\ReportingCloud\PropertyMap;

/**
 * IncorrectWord property map
 */
class IncorrectWord extends AbstractPropertyMap
{
    /**
     * Set the property map of IncorrectWord
     */
    public function __construct()
    {
        $this->setMap([
            'isDuplicate' => 'is_duplicate',
            'language'    => 'language',
            'length'      => 'length',
            'start'       => 'start',
            'text'        => 'text',
        ]);
    }
}
