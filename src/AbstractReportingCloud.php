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

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use TextControl\ReportingCloud\Assert\Assert;
use TextControl\ReportingCloud\Exception\InvalidArgumentException;
use TextControl\ReportingCloud\Exception\RuntimeException;
use TextControl\ReportingCloud\Filter\Filter;
use TextControl\ReportingCloud\Stdlib\ConsoleUtils;

/**
 * Abstract ReportingCloud
 */
abstract class AbstractReportingCloud
{
    // <editor-fold desc="Constants (default values)">
    /**
     * Default date/time format of backend is 'ISO 8601'
     *
     * Note, last letter is 'P' and not 'O':
     *
     * O - Difference to Greenwich time (GMT) in hours (e.g. +0200)
     * P - Difference to Greenwich time (GMT) with colon between hours and minutes (e.g. +02:00)
     *
     * Backend uses the 'P' variant
     *
     * @const DEFAULT_DATE_FORMAT
     * @var string
     */
    final public const DEFAULT_DATE_FORMAT = 'Y-m-d\TH:i:sP';

    /**
     * Default time zone of backend
     *
     * @const DEFAULT_TIME_ZONE
     * @var string
     */
    final public const DEFAULT_TIME_ZONE = 'UTC';

    /**
     * Default base URI of backend
     *
     * @const DEFAULT_BASE_URI
     * @var string
     */
    final public const DEFAULT_BASE_URI = 'https://api.reporting.cloud';

    // </editor-fold>
    // <editor-fold desc="Constants (document dividers)">
    /**
     * Document divider - none
     * @var int
     */
    final public const DOCUMENT_DIVIDER_NONE = 1;

    /**
     * Document divider - new paragraph
     * @var int
     */
    final public const DOCUMENT_DIVIDER_NEW_PARAGRAPH = 2;

    /**
     * Document divider - new section
     * @var int
     */
    final public const DOCUMENT_DIVIDER_NEW_SECTION = 3;

    // </editor-fold>
    // <editor-fold desc="Constants (file formats)">
    /**
     * DOC file format
     * @var string
     */
    final public const FILE_FORMAT_DOC = 'DOC';

    /**
     * DOCX file format
     * @var string
     */
    final public const FILE_FORMAT_DOCX = 'DOCX';

    /**
     * HTML file format
     * @var string
     */
    final public const FILE_FORMAT_HTML = 'HTML';

    /**
     * PDF file format
     * @var string
     */
    final public const FILE_FORMAT_PDF = 'PDF';

    /**
     * PDF/A file format
     * @var string
     */
    final public const FILE_FORMAT_PDFA = 'PDFA';

    /**
     * RTF file format
     * @var string
     */
    final public const FILE_FORMAT_RTF = 'RTF';

    /**
     * TX (Text Control) file format
     * @var string
     */
    final public const FILE_FORMAT_TX = 'TX';

    /**
     * Pure text file format
     * @var string
     */
    final public const FILE_FORMAT_TXT = 'TXT';

    /**
     * Bitmap file format
     * @var string
     */
    final public const FILE_FORMAT_BMP = 'BMP';

    /**
     * GIF file format
     * @var string
     */
    final public const FILE_FORMAT_GIF = 'GIF';

    /**
     * JPEG file format
     * @var string
     */
    final public const FILE_FORMAT_JPG = 'JPG';

    /**
     * PNG file format
     * @var string
     */
    final public const FILE_FORMAT_PNG = 'PNG';

    /**
     * XLSX file format
     * @var string
     */
    final public const FILE_FORMAT_XLSX = 'XLSX';

    // </editor-fold>
    // <editor-fold desc="Constants (tracked changes)">
    /**
     * InsertedText tracked change
     * @var int
     */
    final public const TRACKED_CHANGE_INSERTED_TEXT = 4096;

    /**
     * DeletedText tracked change
     * @var int
     */
    final public const TRACKED_CHANGE_DELETED_TEXT = 8192;

    // </editor-fold>
    // <editor-fold desc="Constants (highlight mode)">
    /**
     * Never highlight mode
     * @var int
     */
    final public const HIGHLIGHT_MODE_NEVER = 1;

    /**
     * Activated highlight mode
     * @var int
     */
    final public const HIGHLIGHT_MODE_ACTIVATED = 2;

    /**
     * Always highlight mode
     * @var int
     */
    final public const HIGHLIGHT_MODE_ALWAYS = 3;

    // </editor-fold>
    // <editor-fold desc="Constants (file format collections)">
    /**
     * Image file formats
     * @var string[]
     */
    final public const FILE_FORMATS_IMAGE
        = [self::FILE_FORMAT_BMP, self::FILE_FORMAT_GIF, self::FILE_FORMAT_JPG, self::FILE_FORMAT_PNG];

    /**
     * Template file formats
     * @var string[]
     */
    final public const FILE_FORMATS_TEMPLATE
        = [self::FILE_FORMAT_DOC, self::FILE_FORMAT_DOCX, self::FILE_FORMAT_RTF, self::FILE_FORMAT_TX];

    /**
     * Document file formats
     * @var string[]
     */
    final public const FILE_FORMATS_DOCUMENT
        = [
            self::FILE_FORMAT_DOC,
            self::FILE_FORMAT_DOCX,
            self::FILE_FORMAT_HTML,
            self::FILE_FORMAT_PDF,
            self::FILE_FORMAT_RTF,
            self::FILE_FORMAT_TX,
        ];

    /**
     * Return file formats
     * @var string[]
     */
    final public const FILE_FORMATS_RETURN
        = [
            self::FILE_FORMAT_DOC,
            self::FILE_FORMAT_DOCX,
            self::FILE_FORMAT_HTML,
            self::FILE_FORMAT_PDF,
            self::FILE_FORMAT_PDFA,
            self::FILE_FORMAT_RTF,
            self::FILE_FORMAT_TX,
            self::FILE_FORMAT_TXT,
        ];

    /**
     * Default debug flag of REST client
     *
     * @const DEFAULT_DEBUG
     * @var bool
     */
    protected const DEFAULT_DEBUG = false;

    /**
     * Default test flag of backend
     *
     * @const DEFAULT_TEST
     * @var bool
     */
    protected const DEFAULT_TEST = false;

    /**
     * Default timeout of backend in seconds
     *
     * @const DEFAULT_TIMEOUT
     * @var int
     */
    protected const DEFAULT_TIMEOUT = 120;

    /**
     * Default version string of backend
     *
     * @const DEFAULT_VERSION
     * @var string
     */
    protected const DEFAULT_VERSION = 'v1';

    // </editor-fold>
    // <editor-fold desc="Properties">
    /**
     * Backend API key
     */
    private string $apiKey;

    /**
     * Backend username
     *
     * @deprecated Use $this->apiKey instead
     */
    private string $username;

    /**
     * Backend password
     *
     * @deprecated Use $this->apiKey instead
     */
    private string $password;

    /**
     * Backend base URI
     */
    private string $baseUri;

    /**
     * Debug flag of REST client
     */
    private bool $debug = false;

    /**
     * When true, API call does not count against quota
     * "TEST MODE" watermark is added to document
     */
    private bool $test = false;

    /**
     * Backend timeout in seconds
     */
    private int $timeout;

    /**
     * Backend version string
     */
    private string $version;

    /**
     * REST client to backend
     */
    private Client $client;

    // </editor-fold>
    // <editor-fold desc="Methods">
    /**
     * Return the API key
     */
    public function getApiKey(): string
    {
        if (!isset($this->apiKey)) {
            $this->apiKey = '';
        }

        return $this->apiKey;
    }

    /**
     * Set the API key
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Return the username
     *
     * @deprecated Use $this->getApiKey(): string instead
     */
    public function getUsername(): string
    {
        if (!isset($this->username)) {
            $this->username = '';
        }

        return $this->username;
    }

    /**
     * Set the username
     *
     * @deprecated Use $this->setApiKey(string $apiKey): self instead
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Return the password
     *
     * @deprecated Use $this->getApiKey() instead
     */
    public function getPassword(): string
    {
        if (!isset($this->password)) {
            $this->password = '';
        }

        return $this->password;
    }

    /**
     * Set the password
     *
     * @deprecated Use $this->setApiKey(string $apiKey): self instead
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Return the base URI of the backend web service
     */
    public function getBaseUri(): string
    {
        if (!isset($this->baseUri)) {
            $baseUri = ConsoleUtils::baseUri();
            if ('' === $baseUri) {
                $baseUri = self::DEFAULT_BASE_URI;
            }
            Assert::assertBaseUri($baseUri);
            $this->setBaseUri($baseUri);
        }

        return $this->baseUri;
    }

    /**
     * Set the base URI of the backend web service
     */
    public function setBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    /**
     * Return the debug flag
     */
    public function getDebug(): bool
    {
        if (!isset($this->debug)) {
            $this->debug = self::DEFAULT_DEBUG;
        }

        return $this->debug;
    }

    /**
     * Set the debug flag
     *
     * @param bool $debug Debug flag
     */
    public function setDebug(bool $debug): self
    {
        $this->debug = $debug;

        return $this;
    }

    /**
     * Return the test flag
     */
    public function getTest(): bool
    {
        if (!isset($this->test)) {
            $this->test = self::DEFAULT_TEST;
        }

        return $this->test;
    }

    /**
     * Set the test flag
     */
    public function setTest(bool $test): self
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get the timeout (in seconds) of the backend web service
     */
    public function getTimeout(): int
    {
        if (!isset($this->timeout)) {
            $this->timeout = self::DEFAULT_TIMEOUT;
        }

        return $this->timeout;
    }

    /**
     * Set the timeout (in seconds) of the backend web service
     */
    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get the version string of the backend web service
     */
    public function getVersion(): string
    {
        if (!isset($this->version)) {
            $this->version = self::DEFAULT_VERSION;
        }

        return $this->version;
    }

    /**
     * Set the version string of the backend web service
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Return the REST client of the backend web service
     */
    public function getClient(): Client
    {
        if (!isset($this->client)) {

            $headers = [
                'Authorization' => $this->getAuthorizationHeader(),
            ];

            $options = [
                'base_uri'              => $this->getBaseUri(),
                RequestOptions::TIMEOUT => $this->getTimeout(),
                RequestOptions::DEBUG   => $this->getDebug(),
                RequestOptions::HEADERS => $headers,
            ];

            $client = new Client($options);

            $this->setClient($client);
        }

        return $this->client;
    }

    /**
     * Set the REST client of the backend web service
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Request the URI with options
     *
     * @param string $method HTTP method
     * @param string $uri URI
     * @param array  $options Options
     */
    protected function request(string $method, string $uri, array $options): ResponseInterface
    {
        $client = $this->getClient();

        try {
            $test = $this->getTest();
            if ($test) {
                assert(is_array($options[RequestOptions::QUERY]));
                $options[RequestOptions::QUERY]['test'] = Filter::filterBooleanToString($test);
            }
            $response = $client->request($method, $uri, $options);
        } catch (GuzzleException $guzzleException) {
            throw new RuntimeException($guzzleException->getMessage(), $guzzleException->getCode());
        }

        return $response;
    }

    /**
     * Construct URI with version number
     *
     * @param string $uri URI
     */
    protected function uri(string $uri): string
    {
        return sprintf('/%s%s', $this->getVersion(), $uri);
    }

    /**
     * Return Authorization Header, with either API key or username and password
     */
    private function getAuthorizationHeader(): string
    {
        $apiKey = $this->getApiKey();

        if (0 < strlen($apiKey)) {
            return sprintf('ReportingCloud-APIKey %s', $apiKey);
        }

        $username = $this->getUsername();
        $password = $this->getPassword();

        if (0 < strlen($username) && 0 < strlen($password)) {
            $value = sprintf('%s:%s', $username, $password);

            return sprintf('Basic %s', base64_encode($value));
        }

        $message = 'Either the API key, or username and password must be set for authorization';
        throw new InvalidArgumentException($message);
    }

    // </editor-fold>
}
