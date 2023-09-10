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

use Ctw\Http\HttpMethod;
use Ctw\Http\HttpStatus;
use GuzzleHttp\RequestOptions;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use TextControl\ReportingCloud\PropertyMap\AbstractPropertyMap as PropertyMap;

/**
 * Trait PutTrait
 */
trait PutTrait
{
    /**
     * Create an API key
     */
    public function createApiKey(): string
    {
        return $this->put('/account/apikey', [], '', HttpStatus::STATUS_CREATED);
    }

    /**
     * Construct URI with version number
     *
     * @param string $uri URI
     */
    abstract protected function uri(string $uri): string;

    /**
     * Request the URI with options
     *
     * @param string $method HTTP method
     * @param string $uri URI
     * @param array  $options Options
     */
    abstract protected function request(string $method, string $uri, array $options): ResponseInterface;

    /**
     * Using the passed propertyMap, recursively build array
     *
     * @param array       $array Array
     * @param PropertyMap $propertyMap PropertyMap
     */
    abstract protected function buildPropertyMapArray(array $array, PropertyMap $propertyMap): array;

    /**
     * Execute a PUT request via REST client
     *
     * @param string  $uri URI
     * @param array[] $query Query
     * @param mixed   $json JSON
     * @param int     $statusCode Required HTTP status code for response
     */
    private function put(string $uri, array $query = [], mixed $json = '', int $statusCode = 0): string
    {
        $ret = '';

        $response = $this->request(HttpMethod::METHOD_PUT, $this->uri($uri), [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON  => $json,
        ]);

        if ($statusCode === $response->getStatusCode()) {
            try {
                $body    = $response->getBody();
                $content = $body->getContents();
                $ret     = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
            } catch (JsonException) {
            }
        }

        assert(is_string($ret));

        return $ret;
    }
}
