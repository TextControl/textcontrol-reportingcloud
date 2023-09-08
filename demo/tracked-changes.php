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

$sourceFilename      = sprintf('%s/tracked_changes.docx', Path::resource());
$destinationFilename = sprintf('%s/tracked_changes.docx', Path::output());

// Show all tracked changes in document

$results = $reportingCloud->getTrackedChanges($sourceFilename);

foreach ($results as $result) {

    assert(is_array($result));

    foreach (array_keys($result) as $key) {
        ConsoleUtils::writeLn('%s: %s', $key);
    }

    ConsoleUtils::writeLn();

    $word = match ($result['change_kind']) {
        ReportingCloud::TRACKED_CHANGE_DELETED_TEXT => 'deleted',
        ReportingCloud::TRACKED_CHANGE_INSERTED_TEXT => 'inserted',
        default => '',
    };

    ConsoleUtils::writeLn('Change kind was "%s" ("%s").', $word);

    $word = match ($result['highlight_mode']) {
        ReportingCloud::HIGHLIGHT_MODE_NEVER => 'never',
        ReportingCloud::HIGHLIGHT_MODE_ACTIVATED => 'activated',
        ReportingCloud::HIGHLIGHT_MODE_ALWAYS => 'always',
        default => '',
    };

    ConsoleUtils::writeLn('Highlight mode was "%s" ("%s").', $word);

    ConsoleUtils::writeLn();
}

// Remove tracked change with ID 1

$result = $reportingCloud->removeTrackedChange($sourceFilename, 1, true);

if (isset($result['document']) && is_string($result['document'])) {
    FileUtils::write($destinationFilename, $result['document']);
    ConsoleUtils::writeLn('Written updated document to "%s".', $destinationFilename);
}
