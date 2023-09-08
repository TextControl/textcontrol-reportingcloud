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
 * TrackedChanges property map
 */
class TrackedChanges extends AbstractPropertyMap
{
    /**
     * Set the property map of TrackedChanges
     */
    public function __construct()
    {
        $this->setMap([
            'changeKind'            => 'change_kind',
            'changeTime'            => 'change_time',
            'defaultHighlightColor' => 'default_highlight_color',
            'highlightColor'        => 'highlight_color',
            'highlightMode'         => 'highlight_mode',
            'id'                    => 'id',
            'length'                => 'length',
            'start'                 => 'start',
            'text'                  => 'text',
            'userName'              => 'username',
        ]);
    }
}
