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

namespace TextControl\ReportingCloud\Stdlib;

use Riimu\Kit\PHPEncoder\PHPEncoder;

/**
 * Class ArrayUtils
 *
 * @package TextControl\ReportingCloud
 * @author  Jonathan Maron (@JonathanMaron)
 */
class ArrayUtils extends AbstractStdlib
{
    /**
     * Write the array of passed data to a file as a PHP structure
     *
     * @param string $filename
     * @param array  $values
     * @param string $generator
     *
     * @return int
     */
    public static function varExportToFile(string $filename, array $values, string $generator = ''): int
    {
        $options = [
            'array.indent'  => 4,
            'array.align'   => true,
            'array.omit'    => true,
            'array.short'   => true,
            'object.format' => 'export',
            'string.utf8'   => true,
            'whitespace'    => true,
        ];

        $encoder = new PHPEncoder($options);

        $format = '<?php';
        $format .= PHP_EOL;
        $format .= 'declare(strict_types=1);';
        $format .= PHP_EOL . PHP_EOL;
        $format .= '%s';
        $format .= 'return ';
        $format .= '%s';
        $format .= ';';
        $format .= PHP_EOL;

        if (0 === strlen($generator)) {
            $prefix = '';
        } else {
            $prefix = sprintf('// File generated by %s.', $generator);
            $prefix .= PHP_EOL;
            $prefix .= '// Do not edit.';
            $prefix .= PHP_EOL . PHP_EOL;
        }

        $buffer = sprintf($format, $prefix, $encoder->encode($values));

        $ret = file_put_contents($filename, $buffer);

        if (!is_int($ret)) {
            $ret = 0;
        }

        return $ret;
    }
}