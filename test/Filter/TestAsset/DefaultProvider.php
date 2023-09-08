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

namespace TextControlTest\ReportingCloud\Filter\TestAsset;

class DefaultProvider
{
    /**
     * @return array<int, array<int, int|string>>
     */
    public static function defaultProvider(): array
    {
        return [
            ['UTC', '1970-01-01T00:00:00+00:00', 0],
            ['UTC', '1993-01-27T21:42:33+00:00', 728_170_953],
            ['UTC', '1996-06-24T09:01:10+00:00', 835_606_870],
            ['UTC', '2003-08-21T04:39:53+00:00', 1_061_440_793],
            ['UTC', '2013-02-10T23:09:47+00:00', 1_360_537_787],

            ['Africa/Algiers', '1987-07-28T21:05:55+00:00', 554_504_755],
            ['Africa/Brazzaville', '1971-10-24T22:56:20+00:00', 57_192_980],
            ['Africa/Dar_es_Salaam', '1989-04-14T15:48:03+00:00', 608_572_083],
            ['Africa/Johannesburg', '1971-08-06T02:02:44+00:00', 50_292_164],
            ['Africa/Libreville', '1982-05-01T07:09:30+00:00', 389_084_970],
            ['America/Antigua', '1999-06-14T10:43:49+00:00', 929_357_029],
            ['America/Argentina/Salta', '2007-04-07T15:35:45+00:00', 1_175_960_145],
            ['America/Asuncion', '1979-09-12T13:53:31+00:00', 305_992_411],
            ['America/Boa_Vista', '2007-08-08T14:30:27+00:00', 1_186_583_427],
            ['America/Cayenne', '1993-12-10T19:15:15+00:00', 755_550_915],
            ['Antarctica/Macquarie', '1977-06-22T10:45:04+00:00', 235_824_304],
            ['Antarctica/Mawson', '1998-11-17T18:11:59+00:00', 911_326_319],
            ['Antarctica/McMurdo', '1989-02-01T19:46:17+00:00', 602_365_577],
            ['Antarctica/Troll', '1975-10-11T15:50:52+00:00', 182_274_652],
            ['Antarctica/Vostok', '2014-06-17T16:22:55+00:00', 1_403_022_175],
            ['Asia/Ashgabat', '1975-08-15T16:24:43+00:00', 177_351_883],
            ['Asia/Bangkok', '1987-12-31T02:02:11+00:00', 567_914_531],
            ['Asia/Choibalsan', '1999-11-25T07:39:19+00:00', 943_515_559],
            ['Asia/Gaza', '1980-06-30T10:50:54+00:00', 331_210_254],
            ['Asia/Jakarta', '1972-10-02T05:32:44+00:00', 86_851_964],
            ['Australia/Adelaide', '1981-04-07T21:33:49+00:00', 355_527_229],
            ['Australia/Broken_Hill', '1988-01-28T05:59:56+00:00', 570_347_996],
            ['Australia/Hobart', '1970-03-26T15:23:43+00:00', 7_313_023],
            ['Australia/Lord_Howe', '1995-05-11T23:06:16+00:00', 800_233_576],
            ['Europe/Athens', '2002-09-16T02:06:03+00:00', 1_032_141_963],
            ['Europe/Busingen', '1977-05-17T00:19:02+00:00', 232_676_342],
            ['Europe/Helsinki', '2011-08-14T14:48:18+00:00', 1_313_333_298],
            ['Europe/Luxembourg', '1971-02-20T09:04:06+00:00', 35_888_646],
            ['Europe/Paris', '1998-04-05T16:14:10+00:00', 891_792_850],
            ['Indian/Antananarivo', '1976-07-10T23:19:06+00:00', 205_888_746],
            ['Indian/Chagos', '1986-09-07T08:06:54+00:00', 526_464_414],
            ['Indian/Christmas', '2010-12-08T21:47:40+00:00', 1_291_844_860],
            ['Indian/Mahe', '2010-02-03T03:22:24+00:00', 1_265_167_344],
            ['Indian/Reunion', '2006-11-13T00:54:05+00:00', 1_163_379_245],
            ['Pacific/Enderbury', '1985-06-04T21:05:54+00:00', 486_767_154],
            ['Pacific/Honolulu', '2010-03-05T03:34:16+00:00', 1_267_760_056],
            ['Pacific/Pago_Pago', '1993-02-27T08:38:30+00:00', 730_802_310],
            ['Pacific/Saipan', '2010-06-21T06:23:16+00:00', 1_277_101_396],
            ['Pacific/Wallis', '1984-12-20T16:24:31+00:00', 472_407_871],
        ];
    }
}
