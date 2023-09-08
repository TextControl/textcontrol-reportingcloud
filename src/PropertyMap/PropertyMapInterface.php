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
 * Property map interface
 */
interface PropertyMapInterface
{
    /**
     * Return the property map
     */
    public function getMap(): array;

    /**
     * Set the property map
     *
     * @param array $map Assoc array of property data
     */
    public function setMap(array $map): self;
}
