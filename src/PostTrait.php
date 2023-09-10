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
use TextControl\ReportingCloud\Assert\Assert;
use TextControl\ReportingCloud\Filter\Filter;
use TextControl\ReportingCloud\PropertyMap\AbstractPropertyMap as PropertyMap;
use TextControl\ReportingCloud\PropertyMap\ModifiedDocument as ModifiedDocumentPropertyMap;
use TextControl\ReportingCloud\PropertyMap\TrackedChanges as TrackedChangesPropertyMap;
use TextControl\ReportingCloud\Stdlib\FileUtils;

/**
 * Trait PostTrait
 */
trait PostTrait
{
    /**
     * Upload a base64 encoded template to template storage
     *
     * @param string $data Template encoded as base64
     * @param string $templateName Template name
     */
    public function uploadTemplateFromBase64(string $data, string $templateName): bool
    {
        Assert::assertBase64Data($data);
        Assert::assertTemplateName($templateName);

        $query = [
            'templateName' => $templateName,
        ];

        $result = $this->post('/templates/upload', $query, $data, HttpStatus::STATUS_CREATED);

        return null === $result;
    }

    /**
     * Upload a template to template storage
     *
     * @param string $templateFilename Template name
     */
    public function uploadTemplate(string $templateFilename): bool
    {
        Assert::assertTemplateExtension($templateFilename);
        Assert::assertFilenameExists($templateFilename);

        $templateName = basename($templateFilename);

        $data = FileUtils::read($templateFilename, true);

        return $this->uploadTemplateFromBase64($data, $templateName);
    }

    /**
     * Convert a document on the local file system to a different format
     *
     * @param string $documentFilename Document filename
     * @param string $returnFormat Return format
     */
    public function convertDocument(string $documentFilename, string $returnFormat): string
    {
        Assert::assertDocumentExtension($documentFilename);
        Assert::assertFilenameExists($documentFilename);
        Assert::assertReturnFormat($returnFormat);

        $query = [
            'returnFormat' => $returnFormat,
        ];

        $data = FileUtils::read($documentFilename, true);

        $result = $this->post('/document/convert', $query, $data, HttpStatus::STATUS_OK);

        if (is_string($result) && 0 < strlen($result)) {
            $decoded = base64_decode($result, true);
            if (is_string($decoded)) {
                return $decoded;
            }
        }

        return '';
    }

    /**
     * Merge data into a template and return an array of binary data.
     * Each record in the array is the binary data of one document
     *
     * @param array  $mergeData Array of merge data
     * @param string $returnFormat Return format
     * @param string $templateName Template name
     * @param string $templateFilename Template filename on local file system
     * @param bool   $append Append flag
     * @param array  $mergeSettings Array of merge settings
     */
    public function mergeDocument(
        array $mergeData,
        string $returnFormat,
        string $templateName = '',
        string $templateFilename = '',
        bool $append = false,
        array $mergeSettings = []
    ): array {

        $query = [];
        $json  = [];

        $json['mergeData'] = $mergeData;

        Assert::assertReturnFormat($returnFormat);
        $query['returnFormat'] = $returnFormat;

        if (0 < strlen($templateName)) {
            Assert::assertTemplateName($templateName);
            $query['templateName'] = $templateName;
        }

        if (0 < strlen($templateFilename)) {
            Assert::assertTemplateExtension($templateFilename);
            Assert::assertFilenameExists($templateFilename);
            $json['template'] = FileUtils::read($templateFilename, true);
        }

        if ($append) {
            //Assert::assertBoolean($append);
            $query['append'] = Filter::filterBooleanToString($append);
        }

        if ([] !== $mergeSettings) {
            $json['mergeSettings'] = $this->buildMergeSettingsArray($mergeSettings);
        }

        $result = $this->post('/document/merge', $query, $json, HttpStatus::STATUS_OK);

        if (is_array($result)) {
            foreach ($result as $key => $value) {
                $value = base64_decode($value, true);
                assert(is_string($value));
                $result[$key] = $value;
            }

            return $result;
        }

        return [];
    }

    /**
     * Combine documents by appending them, divided by a new section, paragraph or nothing
     */
    public function appendDocument(array $documentsData, string $returnFormat, array $documentSettings = []): string
    {

        $query = [];
        $json  = [];

        $json['documents'] = $this->buildDocumentsArray($documentsData);

        Assert::assertReturnFormat($returnFormat);
        $query['returnFormat'] = $returnFormat;

        if ([] !== $documentSettings) {
            $json['documentSettings'] = $this->buildDocumentSettingsArray($documentSettings);
        }

        $result = $this->post('/document/append', $query, $json, HttpStatus::STATUS_OK);

        if (is_string($result) && 0 < strlen($result)) {
            $decoded = base64_decode($result, true);
            if (is_string($decoded)) {
                return $decoded;
            }
        }

        return '';
    }

    /**
     * Perform find and replace in document and return binary data.
     *
     * @param array  $findAndReplaceData Array of find and replace data
     * @param string $returnFormat Return format
     * @param string $templateName Template name
     * @param string $templateFilename Template filename on local file system
     * @param array  $mergeSettings Array of merge settings
     */
    public function findAndReplaceDocument(
        array $findAndReplaceData,
        string $returnFormat,
        string $templateName = '',
        string $templateFilename = '',
        array $mergeSettings = []
    ): string {
        $query = [];
        $json  = [];

        $json['findAndReplaceData'] = $this->buildFindAndReplaceDataArray($findAndReplaceData);

        Assert::assertReturnFormat($returnFormat);
        $query['returnFormat'] = $returnFormat;

        if (0 < strlen($templateName)) {
            Assert::assertTemplateName($templateName);
            $query['templateName'] = $templateName;
        }

        if (0 < strlen($templateFilename)) {
            Assert::assertTemplateExtension($templateFilename);
            Assert::assertFilenameExists($templateFilename);
            $json['template'] = FileUtils::read($templateFilename, true);
        }

        if ([] !== $mergeSettings) {
            $json['mergeSettings'] = $this->buildMergeSettingsArray($mergeSettings);
        }

        $result = $this->post('/document/findandreplace', $query, $json, HttpStatus::STATUS_OK);

        if (is_string($result) && 0 < strlen($result)) {
            $decoded = base64_decode($result, true);
            if (is_string($decoded)) {
                return $decoded;
            }
        }

        return '';
    }

    /**
     * Generate a thumbnail image per page of specified document filename.
     * Return an array of binary data with each record containing one thumbnail.
     *
     * @param string $documentFilename Document filename
     * @param int    $zoomFactor Zoom factor
     * @param int    $fromPage From page
     * @param int    $toPage To page
     * @param string $imageFormat Image format
     */
    public function getDocumentThumbnails(
        string $documentFilename,
        int $zoomFactor,
        int $fromPage,
        int $toPage,
        string $imageFormat
    ): array {

        Assert::assertDocumentThumbnailExtension($documentFilename);
        Assert::assertFilenameExists($documentFilename);
        Assert::assertZoomFactor($zoomFactor);
        Assert::assertPage($fromPage);
        Assert::assertPage($toPage);
        Assert::assertImageFormat($imageFormat);

        $query = [
            'zoomFactor'  => $zoomFactor,
            'fromPage'    => $fromPage,
            'toPage'      => $toPage,
            'imageFormat' => $imageFormat,
        ];

        $data = FileUtils::read($documentFilename, true);

        $result = $this->post('/document/thumbnails', $query, $data, HttpStatus::STATUS_OK);

        if (is_array($result)) {
            foreach ($result as $key => $value) {
                $value = base64_decode($value, true);
                assert(is_string($value));
                $result[$key] = $value;
            }

            return $result;
        }

        return [];
    }

    /**
     * Return the tracked changes in a document.
     *
     * @param string $documentFilename Document filename
     */
    public function getTrackedChanges(string $documentFilename): array
    {
        $ret = [];

        $propertyMap = new TrackedChangesPropertyMap();

        Assert::assertDocumentExtension($documentFilename);
        Assert::assertFilenameExists($documentFilename);

        $data = FileUtils::read($documentFilename, true);

        $result = $this->post('/processing/review/trackedchanges', [], $data, HttpStatus::STATUS_OK);

        if (is_array($result)) {
            $ret = $this->buildPropertyMapArray($result, $propertyMap);
            array_walk($ret, static function (array &$record): void {
                $key = 'change_time';
                if (isset($record[$key])) {
                    //@todo [20190902] return value of backend DateTime in Zulu timezone
                    //Assert::assertDateTime($record[$key]);
                    $record[$key] = Filter::filterDateTimeToTimestamp($record[$key]);
                }
            });
        }

        return $ret;
    }

    /**
     * Removes a specific tracked change and returns the resulting document.
     *
     * @param string $documentFilename Document filename
     * @param int    $id The ID of the tracked change that needs to be removed
     * @param bool   $accept Specifies whether the tracked change should be accepted or not (reject)
     */
    public function removeTrackedChange(string $documentFilename, int $id, bool $accept): array
    {
        $ret = [];

        $propertyMap = new ModifiedDocumentPropertyMap();

        Assert::assertDocumentExtension($documentFilename);
        Assert::assertFilenameExists($documentFilename);

        $query = [
            'id'     => $id,
            'accept' => Filter::filterBooleanToString($accept),
        ];

        $data = FileUtils::read($documentFilename, true);

        $result = $this->post('/processing/review/removetrackedchange', $query, $data, HttpStatus::STATUS_OK);

        if (is_array($result)) {
            $ret = $this->buildPropertyMapArray($result, $propertyMap);
            $key = 'document';
            if (isset($ret[$key]) && is_string($ret[$key])) {
                $ret[$key] = base64_decode($ret[$key], true);
            }
        }

        return $ret;
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
     * Using passed findAndReplaceData associative array (key-value), build array for backend (list of string arrays)
     *
     * @param array $array FindAndReplaceData array
     */
    abstract protected function buildFindAndReplaceDataArray(array $array): array;

    /**
     * Using passed mergeSettings array, build array for backend
     *
     * @param array $array MergeSettings array
     */
    abstract protected function buildMergeSettingsArray(array $array): array;

    /**
     * Using passed documentsData array, build array for backend
     *
     * @param array $array AppendDocument array
     */
    abstract protected function buildDocumentsArray(array $array): array;

    /**
     * Using passed documentsSettings array, build array for backend
     */
    abstract protected function buildDocumentSettingsArray(array $array): array;

    /**
     * Using the passed propertyMap, recursively build array
     *
     * @param array       $array Array
     * @param PropertyMap $propertyMap PropertyMap
     */
    abstract protected function buildPropertyMapArray(array $array, PropertyMap $propertyMap): array;

    /**
     * Execute a POST request via REST client
     *
     * @param string $uri URI
     * @param array  $query Query
     * @param mixed  $json JSON
     * @param int    $statusCode Required HTTP status code for response
     */
    private function post(string $uri, array $query = [], mixed $json = '', int $statusCode = 0): mixed
    {
        $ret = null;

        $response = $this->request(HttpMethod::METHOD_POST, $this->uri($uri), [
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

        return $ret;
    }
}
