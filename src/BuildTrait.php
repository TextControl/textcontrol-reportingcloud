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

namespace TextControl\ReportingCloud;

use TextControl\ReportingCloud\Assert\Assert;
use TextControl\ReportingCloud\Filter\Filter;
use TextControl\ReportingCloud\PropertyMap\AbstractPropertyMap as PropertyMap;
use TextControl\ReportingCloud\PropertyMap\DocumentSettings as DocumentSettingsPropertyMap;
use TextControl\ReportingCloud\PropertyMap\MergeSettings as MergeSettingsPropertyMap;
use TextControl\ReportingCloud\Stdlib\FileUtils;
use TextControl\ReportingCloud\Stdlib\StringUtils;

/**
 * Trait BuildTrait
 */
trait BuildTrait
{
    /**
     * Using the passed propertyMap, recursively build array
     *
     * @param array       $array       Array
     * @param PropertyMap $propertyMap PropertyMap
     */
    protected function buildPropertyMapArray(array $array, PropertyMap $propertyMap): array
    {
        $ret = [];

        foreach ($array as $key => $value) {
            $map = $propertyMap->getMap();
            if (isset($map[$key])) {
                $key = $map[$key];
            }
            if (is_array($value)) {
                $value = $this->buildPropertyMapArray($value, $propertyMap);
            }
            $ret[$key] = $value;
        }

        return $ret;
    }

    /**
     * Using passed documentsData array, build array for backend
     */
    protected function buildDocumentsArray(array $array): array
    {
        $ret = [];

        foreach ($array as $inner) {
            assert(is_array($inner));
            $document = [];
            foreach ($inner as $key => $value) {
                if ('filename' === $key) {
                    assert(is_string($value));
                    Assert::assertFilenameExists($value);
                    Assert::assertDocumentExtension($value);
                    $document['document'] = FileUtils::read($value, true);
                } elseif ('divider' === $key) {
                    assert(is_int($value));
                    Assert::assertDocumentDivider($value);
                    $document['documentDivider'] = $value;
                }
            }
            $ret[] = $document;
        }

        return $ret;
    }

    /**
     * Using passed documentsSettings array, build array for backend
     */
    protected function buildDocumentSettingsArray(array $array): array
    {
        $ret = [];

        $propertyMap = new DocumentSettingsPropertyMap();

        $map = $propertyMap->getMap();

        if ([] === $map) {
            return $ret;
        }

        foreach ($map as $property => $key) {
            if (!isset($array[$key])) {
                continue;
            }
            $value = $array[$key];
            if (StringUtils::endsWith($key, '_date') && is_int($value)) {
                Assert::assertTimestamp($value);
                $value = Filter::filterTimestampToDateTime($value);
            }
            $ret[$property] = $value;
        }

        return $ret;
    }

    /**
     * Using passed mergeSettings array, build array for backend
     *
     * @param array $array MergeSettings array
     */
    protected function buildMergeSettingsArray(array $array): array
    {
        $ret = [];

        $propertyMap = new MergeSettingsPropertyMap();

        $map = $propertyMap->getMap();

        if ([] === $map) {
            return $ret;
        }

        foreach ($map as $property => $key) {
            if (!isset($array[$key])) {
                continue;
            }
            $value = $array[$key];
            if ('culture' === $key) {
                assert(is_string($value));
                Assert::assertCulture($value);
            }
            if (StringUtils::startsWith($key, 'remove_')) {
                Assert::assertRemove($value);
                assert(is_bool($value));
            }
            if (StringUtils::endsWith($key, '_date')) {
                assert(is_int($value));
                Assert::assertTimestamp($value);
                $value = Filter::filterTimestampToDateTime($value);
            }
            $ret[$property] = $value;
        }

        return $ret;
    }

    /**
     * Using passed findAndReplaceData associative array (key-value), build array for backend (list of string arrays)
     */
    protected function buildFindAndReplaceDataArray(array $array): array
    {
        $ret = [];

        foreach ($array as $key => $value) {
            $ret[] = [$key, $value];
        }

        return $ret;
    }
}
