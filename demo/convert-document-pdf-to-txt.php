<?php
declare(strict_types=1);

include_once __DIR__ . '/bootstrap.php';

use TextControl\ReportingCloud\ReportingCloud;
use TextControl\ReportingCloud\Stdlib\ConsoleUtils;
use TextControl\ReportingCloud\Stdlib\FileUtils;
use TextControl\ReportingCloud\Stdlib\Path;

// Instantiate with API key via constructor options

$reportingCloud = new ReportingCloud([
    'api_key' => ConsoleUtils::apiKey(),
]);

// Specify the source (PDF) and destination (TXT) filenames

$sourceFilename      = sprintf('%s/maelzel_machine.pdf', Path::resource());
$destinationFilename = sprintf('%s/maelzel_machine.txt', Path::output());

// Using ReportingCloud, convert the PDF file to TXT file

$binaryData = $reportingCloud->convertDocument($sourceFilename, ReportingCloud::FILE_FORMAT_TXT);

// Write the document's binary data to disk

FileUtils::write($destinationFilename, $binaryData);

// Output to console the location of the generated document

ConsoleUtils::writeLn('"%s" was converted and written to "%s".', $sourceFilename);
