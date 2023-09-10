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

namespace TextControl\ReportingCloud;

class ReportingCloud extends AbstractReportingCloud
{
    use BuildTrait;
    use DeleteTrait;
    use GetTrait;
    use PostTrait;
    use PutTrait;

    public function __construct(array $options = [])
    {
        if ([] === $options) {
            return;
        }

        $methods = [
            // Credentials
            'api_key'  => 'setApiKey',
            // Credentials (deprecated, use 'api_key' only)
            'username' => 'setUsername',
            'password' => 'setPassword',
            // Options
            'base_uri' => 'setBaseUri',
            'debug'    => 'setDebug',
            'test'     => 'setTest',
            'timeout'  => 'setTimeout',
            'version'  => 'setVersion',
        ];

        foreach ($methods as $key => $method) {
            if (array_key_exists($key, $options)) {
                // @phpstan-ignore-next-line
                $this->{$method}($options[$key]);
            }
        }
    }
}
