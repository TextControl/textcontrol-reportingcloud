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

namespace TextControlTest\ReportingCloud\Assert\TestAsset;

use TextControl\ReportingCloud\Assert\AbstractAssert;
use TextControl\ReportingCloud\Assert\ValueToStringTrait;

/**
 * Class ConcreteAssert (for testing only)
 *
 * @package TextControlTest\ReportingCloud
 * @author  Jonathan Maron (@JonathanMaron)
 */
class ConcreteAssert extends AbstractAssert
{
    use ValueToStringTrait;

    /**
     * Convert value to string (public version for testing)
     *
     * @param mixed $value
     *
     * @return string
     */
    public static function publicValueToString($value): string
    {
        return self::valueToString($value);
    }
}
