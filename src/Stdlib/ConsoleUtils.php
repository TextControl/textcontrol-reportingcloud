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
 * @copyright © 2023 Text Control GmbH
 */

namespace TextControl\ReportingCloud\Stdlib;

/**
 * ReportingCloud console helper (used only for tests and demos)
 */
class ConsoleUtils extends AbstractStdlib
{
    /**
     * Name of PHP constant or environmental variable storing API key
     *
     * @const REPORTING_CLOUD_API_KEY
     * @var string
     */
    final public const API_KEY = 'REPORTING_CLOUD_API_KEY';

    /**
     * Name of PHP constant or environmental variable storing base URI
     *
     * @const REPORTING_CLOUD_BASE_URI
     * @var string
     */
    final public const BASE_URI = 'REPORTING_CLOUD_BASE_URI';

    /**
     * Check that either the API key has been defined in environment variables
     */
    public static function checkCredentials(): bool
    {
        return 0 < strlen(self::apiKey());
    }

    /**
     * Return the ReportingCloud API key from a PHP constant or environmental variable
     */
    public static function apiKey(): string
    {
        return self::getValueFromConstOrEnvVar(self::API_KEY);
    }

    /**
     * Return the ReportingCloud base URI from a PHP constant or environmental variable
     */
    public static function baseUri(): string
    {
        return self::getValueFromConstOrEnvVar(self::BASE_URI);
    }

    /**
     * Return error message explaining how to configure PHP constant or environmental variables
     */
    public static function errorMessage(): string
    {
        // phpcs:disable

        $format   = <<<END

\e[41m\e[1mError: ReportingCloud API key not defined.\e[0m

In order to execute \e[32m%s\e[0m, you must first set your ReportingCloud API key.

There are two ways in which you can do this:

1) Define a PHP constant:

    \e[1mdefine('%s', '%s');\e[0m

2) Set an environmental variable (for example in .bashrc)
    
    \e[1mexport %s='%s'\e[0m

Note, these instructions apply only to the demo scripts and phpunit tests. 

When you use ReportingCloud in your application, set the API key in your constructor or using the 'setApiKey(string \$apiKey):self' method. 

For an example, see \e[32m'/demo/instantiation.php'\e[0m.

For further assistance and customer service please refer to:

    https://www.reporting.cloud
    

END;
        // phpcs:enable

        $filename = $_SERVER['argv'][0] ?? '';
        $filename = realpath($filename);

        if (is_bool($filename)) {
            $name = 'this script';
        } else {
            $base = dirname(__FILE__, 3);
            $file = str_replace($base, '', $filename);
            $name = sprintf("'%s'", $file);
        }

        $key   = self::API_KEY;
        $value = 'your-api-key';

        $ret = sprintf($format, $name, $key, $value, $key, $value);

        return wordwrap($ret, 80);
    }

    /**
     * Dump information about a variable
     */
    public static function dump(mixed $value): void
    {
        /** @scrutinizer ignore-call */ var_dump($value);
    }

    /**
     * Write a line to the console
     */
    public static function writeLn(string $format = '', array $args = []): void
    {
        if ([] !== $args) {
            echo vsprintf($format, $args);
        } else {
            echo $format;
        }

        echo PHP_EOL;
    }

    /**
     * Return a value from a PHP constant or environmental variable
     */
    private static function getValueFromConstOrEnvVar(string $key): string
    {
        $value = self::getValueFromConst($key);

        if (0 < strlen($value)) {
            return $value;
        }

        $value = self::getValueFromEnvVar($key);

        if (0 < strlen($value)) {
            return $value;
        }

        return '';
    }

    /**
     * Return a value from a PHP constant
     */
    private static function getValueFromConst(string $key): string
    {
        if (defined($key)) {
            $value = constant($key);
            if (is_string($value)) {
                $value = trim($value);
                if (0 < strlen($value)) {
                    return $value;
                }
            }
        }

        return '';
    }

    /**
     * Return a value from an environmental variable
     */
    private static function getValueFromEnvVar(string $key): string
    {
        $value = getenv($key);

        if (is_string($value)) {
            $value = trim($value);
            if (0 < strlen($value)) {
                return $value;
            }
        }

        return '';
    }
}
