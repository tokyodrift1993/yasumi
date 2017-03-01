<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Chile;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing the public holiday in respect of the 2017 Census in Chile (April 19th, 2017).
 *
 */
class CensusDay2017Test extends ChileBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = '2017CensusDay';

    /**
     * The year in which the holiday was established
     */
    const ESTABLISHMENT_YEAR = 2017;

    /**
     * Tests the holiday defined in this test on establishment.
     */
    public function testHolidayOnEstablishment()
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR,
            new DateTime(self::ESTABLISHMENT_YEAR . '-4-19', new DateTimeZone(self::TIMEZONE)));
        $this->assertDayOfWeek(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR, 'Wednesday');
    }

    /**
     * Tests the holiday defined in this test before establishment.
     */
    public function testHolidayBeforeEstablishment()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }

    /**
     * Tests the holiday defined in this test after completion.
     */
    public function testHolidayDayAfterCompletion()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(self::ESTABLISHMENT_YEAR + 1));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Censo abreviado 2017']);
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::ESTABLISHMENT_YEAR), Holiday::TYPE_NATIONAL);
    }
}
