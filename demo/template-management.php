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

// Specify the template name

$templateName = 'test_template.tx';

// Specify the source (TX) and destination (TX) filenames

$sourceFilename      = sprintf('%s/%s', Path::resource(), $templateName);
$destinationFilename = sprintf('%s/%s', Path::output(), $templateName);


// Check to see whether a template is in template storage
// Uploaded, if it is not

if (!$reportingCloud->templateExists($templateName)) {
    ConsoleUtils::writeLn('"%s" is not in template storage', $templateName);
    if ($reportingCloud->uploadTemplate($sourceFilename)) {
        ConsoleUtils::writeLn('Uploaded "%s".', $sourceFilename);
    } else {
        ConsoleUtils::writeLn('Error uploading "%s".', $sourceFilename);
    }
}


// Get the number of pages in a template

$pageCount = $reportingCloud->getTemplatePageCount($templateName);

ConsoleUtils::writeLn('"%s" contains %d page%s.', $templateName, $pageCount, 1 < $pageCount ? 's' : '');


// Download a template from template storage

$binaryData = $reportingCloud->downloadTemplate($templateName);

if (0 < strlen($binaryData)) {
    ConsoleUtils::writeLn('"%s" was downloaded.', $templateName);
    // Write the document's binary data to disk
    FileUtils::write($destinationFilename, $binaryData);
    ConsoleUtils::writeLn('"%s" was written to "%s".', $templateName, $destinationFilename);
} else {
    ConsoleUtils::writeLn('Error downloading "%s".', $templateName);
}


// Count the number of templates in template storage

$templateCount = $reportingCloud->getTemplateCount();

ConsoleUtils::writeLn('There are %d template%s in template storage.', $templateCount, 1 < $templateCount ? 's' : '');


// Get an array of all templates in template storage

ConsoleUtils::writeLn('They are as follows:');

foreach ($reportingCloud->getTemplateList() as $record) {

    assert(is_array($record));

    assert(isset($record['modified']));
    assert(isset($record['template_name']));

    assert(is_int($record['modified']));
    assert(is_string($record['template_name']));

    $templateName      = $record['template_name'];
    $modifiedFormatted = date('r', $record['modified']);    // modified is a unix timestamp

    ConsoleUtils::writeLn('- %s', $templateName);
    ConsoleUtils::writeLn('- %s', $record['modified']);
    ConsoleUtils::writeLn('- %s', $modifiedFormatted);
}


// Delete a template in template storage

if ($reportingCloud->deleteTemplate($templateName)) {
    ConsoleUtils::writeLn('"%s" was deleted.', $templateName);
} else {
    ConsoleUtils::writeLn('Error deleting "%s".', $templateName);
}
