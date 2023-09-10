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

class Assert extends AbstractAssert
{
    use AssertApiKeyTrait;
    use AssertBase64DataTrait;
    use AssertBaseUriTrait;
    use AssertCultureTrait;
    use AssertDateTimeTrait;
    use AssertDocumentDividerTrait;
    use AssertDocumentExtensionTrait;
    use AssertDocumentThumbnailExtensionTrait;
    use AssertFilenameExistsTrait;
    use AssertImageFormatTrait;
    use AssertLanguageTrait;
    use AssertOneOfTrait;
    use AssertPageTrait;
    use AssertRangeTrait;
    use AssertRemoveTrait;
    use AssertReturnFormatTrait;
    use AssertTemplateExtensionTrait;
    use AssertTemplateFormatTrait;
    use AssertTemplateNameTrait;
    use AssertTimestampTrait;
    use AssertZoomFactorTrait;
    use ValueToStringTrait;
}
