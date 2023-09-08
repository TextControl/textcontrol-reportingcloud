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

use Ctw\Http\HttpMethod;
use Ctw\Http\HttpStatus;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use TextControl\ReportingCloud\Assert\Assert;

/**
 * Trait DeleteTrait
 */
trait DeleteTrait
{
    /**
     * Delete an API key
     */
    public function deleteApiKey(string $key): bool
    {
        Assert::assertApiKey($key);

        $query = [
            'key' => $key,
        ];

        return $this->delete('/account/apikey', $query, '', HttpStatus::STATUS_OK);
    }

    /**
     * Delete a template in template storage
     */
    public function deleteTemplate(string $templateName): bool
    {
        Assert::assertTemplateName($templateName);

        $query = [
            'templateName' => $templateName,
        ];

        return $this->delete('/templates/delete', $query, '', HttpStatus::STATUS_NO_CONTENT);
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
     * @param string $method  HTTP method
     * @param string $uri     URI
     * @param array  $options Options
     */
    abstract protected function request(string $method, string $uri, array $options): ResponseInterface;

    /**
     * Execute a DELETE request via REST client
     *
     * @param string $uri        URI
     * @param array  $query      Query
     * @param mixed  $json       JSON
     * @param int    $statusCode Required HTTP status code for response
     */
    private function delete(string $uri, array $query = [], mixed $json = '', int $statusCode = 0): bool
    {
        $response = $this->request(HttpMethod::METHOD_DELETE, $this->uri($uri), [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON  => $json,
        ]);

        return $statusCode === $response->getStatusCode();
    }
}
