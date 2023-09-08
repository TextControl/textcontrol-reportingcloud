<?php
declare(strict_types=1);

include_once __DIR__ . '/bootstrap.php';

use TextControl\ReportingCloud\ReportingCloud;
use TextControl\ReportingCloud\Stdlib\ConsoleUtils;

// Instantiate with API key via constructor options

$reportingCloud = new ReportingCloud([
    'api_key' => ConsoleUtils::apiKey(),
]);

// Iterate over the account settings array, outputting the key-value pairs to the console

foreach (array_keys($reportingCloud->getAccountSettings()) as $key) {
    ConsoleUtils::writeLn('- %s: %s', $key);
}
