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

namespace TextControlTest\ReportingCloud\Stdlib;

use TextControl\ReportingCloud\Stdlib\FileUtils;
use TextControlTest\ReportingCloud\AbstractReportingCloudTestCase;

class FileUtilsTest extends AbstractReportingCloudTestCase
{
    /**
     * @var string
     */
    final public const BINARY_PATTERN = '~[^\x20-\x7E\t\r\n]~';

    public function testReadBase64EncodeFalse(): void
    {
        $sourceFilename = $this->getTestDocumentFilename();

        $binaryData = FileUtils::read($sourceFilename);
        $valid      = (0 < preg_match(self::BINARY_PATTERN, $binaryData));
        self::assertTrue($valid);
    }

    public function testReadBase64EncodeTrue(): void
    {
        $sourceFilename = $this->getTestDocumentFilename();

        $base64EncodedData = FileUtils::read($sourceFilename, true);
        $binaryData        = base64_decode($base64EncodedData, true);
        $valid = is_string($binaryData) && 0 < strlen($binaryData);
        self::assertTrue($valid);
    }

    public function testWriteBase64EncodedFalse(): void
    {
        $sourceFilename      = $this->getTestDocumentFilename();
        $destinationFilename = $this->getTempDocumentFilename();

        $binaryData = FileUtils::read($sourceFilename, false);

        FileUtils::write($destinationFilename, $binaryData, false);

        $valid = file_exists($destinationFilename);
        self::assertTrue($valid);

        $binaryData = (string) file_get_contents($destinationFilename);
        $valid      = (0 < preg_match(self::BINARY_PATTERN, $binaryData));
        self::assertTrue($valid);
    }

    public function testWriteBase64EncodedTrue(): void
    {
        $sourceFilename      = $this->getTestDocumentFilename();
        $destinationFilename = $this->getTempDocumentFilename();

        $binaryData = FileUtils::read($sourceFilename, true);

        FileUtils::write($destinationFilename, $binaryData, true);

        $valid = file_exists($destinationFilename);
        self::assertTrue($valid);

        $binaryData = (string) file_get_contents($destinationFilename);
        $valid      = (0 < preg_match(self::BINARY_PATTERN, $binaryData));
        self::assertTrue($valid);
    }
}
