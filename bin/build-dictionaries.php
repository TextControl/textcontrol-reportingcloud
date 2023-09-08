<?php
declare(strict_types=1);

/**
 * Available Dictionaries Resource File
 *
 * This script downloads all the available dictionaries from the Reporting Cloud Web API and writes them to the file:
 *
 *    resource/dictionaries.php
 *
 * The package maintainer should execute this script, whenever new dictionaries are added to the backend.
 */

include_once __DIR__ . '/bootstrap.php';

use TextControl\ReportingCloud\Assert\Assert;
use TextControl\ReportingCloud\Exception\RuntimeException;
use TextControl\ReportingCloud\ReportingCloud;
use TextControl\ReportingCloud\Stdlib\ArrayUtils;
use TextControl\ReportingCloud\Stdlib\ConsoleUtils;

// ---------------------------------------------------------------------------------------------------------------------

$filename = Assert::getDictionariesFilename();

$reportingCloud = new ReportingCloud([
    'api_key' => ConsoleUtils::apiKey(),
]);

$values = $reportingCloud->getAvailableDictionaries();

if ([] === $values) {
    $message = 'Cannot download the available dictionaries from the Reporting Cloud Web API.';
    throw new RuntimeException($message);
}

natcasesort($values);
$values = array_values($values);

// ---------------------------------------------------------------------------------------------------------------------

$search    = dirname(__FILE__, 2);
$replace   = '';
$generator = str_replace($search, $replace, __FILE__);

ArrayUtils::varExportToFile($filename, $values, $generator);

ConsoleUtils::writeLn();
ConsoleUtils::writeLn('The available dictionaries (%d) are %s.', count($values), implode(', ', $values));
ConsoleUtils::writeLn();
ConsoleUtils::writeLn('Written data file to "%s".', $filename);
ConsoleUtils::writeLn();

// ---------------------------------------------------------------------------------------------------------------------
