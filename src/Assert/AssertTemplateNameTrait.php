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

namespace TextControl\ReportingCloud\Assert;

use TextControl\ReportingCloud\Exception\InvalidArgumentException;

/**
 * Trait AssertTemplateNameTrait
 */
trait AssertTemplateNameTrait
{
    use AssertTemplateFormatTrait;
    use ValueToStringTrait;

    /**
     * Check value is a valid template name
     */
    public static function assertTemplateName(string $value, string $message = ''): void
    {
        if (basename($value) !== $value) {
            $format  = '' === $message ? '%1$s contains path information (\'/\', \'.\', or \'..\')' : $message;
            $message = sprintf($format, self::valueToString($value));
            throw new InvalidArgumentException($message);
        }

        $extension = pathinfo($value, PATHINFO_EXTENSION);

        try {
            self::assertTemplateFormat(/** @scrutinizer ignore-type */ $extension);
        } catch (InvalidArgumentException) {
            $format  = '' === $message ? '%1$s contains an unsupported file extension' : $message;
            $message = sprintf($format, self::valueToString($value));
            throw new InvalidArgumentException($message);
        }
    }
}
