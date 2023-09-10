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

class FileUtils extends AbstractStdlib
{
    /**
     * Read a filename from filesystem and return its binary data.
     * Optionally, base64 encode the returned binary data.
     */
    public static function read(string $filename, bool $base64Encode = false): string
    {
        $binaryData = file_get_contents($filename);
        assert(is_string($binaryData));

        if ($base64Encode) {
            $binaryData = base64_encode($binaryData);
        }

        return $binaryData;
    }

    /**
     * Write binary data to a filename on filesystem.
     * Optionally, based decode the binary data before writing.
     */
    public static function write(string $filename, string $binaryData, bool $base64Encoded = false): bool
    {
        if ($base64Encoded) {
            $binaryData = base64_decode($binaryData, true);
            assert(is_string($binaryData));
        }

        $result = file_put_contents($filename, $binaryData);

        return is_int($result) && 0 < $result;
    }
}
