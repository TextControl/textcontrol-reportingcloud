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
    'test'    => true,
]);

// Specify the source (TX) and destination (PDF) filenames

$sourceFilename      = sprintf('%s/test_find_and_replace.tx', Path::resource());
$destinationFilename = sprintf('%s/test_find_and_replace.pdf', Path::output());

// Create an array of find and replace data

$findAndReplaceData = [
    '%%FIELD1%%' => 'hello field 1',
    '%%FIELD2%%' => 'hello field 2',
];

// Create an array of PDF document properties

$mergeSettings = [
    'author'                     => 'James Henry Trotter',
    'creation_date'              => time(),
    'creator_application'        => 'The Giant Peach',
    'document_subject'           => 'The Old Green Grasshopper',
    'document_title'             => 'James and the Giant Peach',
    'last_modification_date'     => time(),
    'merge_html'                 => false,
    'remove_empty_blocks'        => true,
    'remove_empty_fields'        => true,
    'remove_empty_images'        => true,
    'remove_trailing_whitespace' => true,
    'user_password'              => '1', // NOTE: You need to enter this password when opening the PDF file
];

// Using ReportingCloud, find and replace the strings and return the PDF file

$binaryData = $reportingCloud->findAndReplaceDocument(
    $findAndReplaceData,
    ReportingCloud::FILE_FORMAT_PDF,
    '',
    $sourceFilename,
    $mergeSettings
);

// Write the document's binary data to disk

FileUtils::write($destinationFilename, $binaryData);

// Output to console the location of the generated document

ConsoleUtils::writeLn('Written to "%s".', [$destinationFilename]);
