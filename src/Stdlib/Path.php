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

namespace TextControl\ReportingCloud\Stdlib;

class Path
{
    /**
     * Return the root path of PHP SDK for ReportingCloud Web API
     */
    public static function root(): string
    {
        return dirname(__FILE__, 3);
    }

    /**
     * Return the binary path of PHP SDK for ReportingCloud Web API
     */
    public static function bin(): string
    {
        return sprintf('%s/bin', self::root());
    }

    /**
     * Return the data path of PHP SDK for ReportingCloud Web API
     */
    public static function data(): string
    {
        return sprintf('%s/data', self::root());
    }

    /**
     * Return the demo path of PHP SDK for ReportingCloud Web API
     */
    public static function demo(): string
    {
        return sprintf('%s/demo', self::root());
    }

    /**
     * Return the output path of PHP SDK for ReportingCloud Web API
     */
    public static function output(): string
    {
        return sprintf('%s/output', self::root());
    }

    /**
     * Return the resources path of PHP SDK for ReportingCloud Web API
     */
    public static function resource(): string
    {
        return sprintf('%s/resource', self::root());
    }

    /**
     * Return the rest path of PHP SDK for ReportingCloud Web API
     */
    public static function test(): string
    {
        return sprintf('%s/test', self::root());
    }
}
