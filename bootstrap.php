<?php
declare(strict_types=1);

use TextControl\ReportingCloud\Stdlib\ConsoleUtils;

/**
 * This file bootstraps all console scripts:
 *
 * - test
 * - demo
 * - bin
 */

/**
 * @return string
 */
$autoloadFilename = static function (): string {
    // standard composer autoload file
    $file = 'autoload.php';
    $paths = [
        // when installed as a dependency to another project
        dirname(__FILE__, 3),
        // when installed as a GIT clone
        __DIR__ . '/vendor',
    ];
    foreach ($paths as $path) {
        $filename = sprintf('%s/%s', $path, $file);
        if (is_readable($filename)) {
            return $filename;
        }
    }
    $format  = "Cannot load composer's %s. Tried: %s. Did you run 'composer install'?";
    $message = sprintf($format, $file, implode(', ', $paths));
    throw new RuntimeException($message);
};

include $autoloadFilename();

if (!ConsoleUtils::checkCredentials()) {
    echo ConsoleUtils::errorMessage();
    die(1);
}
