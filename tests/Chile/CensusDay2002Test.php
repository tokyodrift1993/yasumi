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
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing the public holiday in respect of the 2002 Census in Chile (April 24th, 2002).
 *
 */
class CensusDay2002Test extends ChileBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    private const HOLIDAY = '2002CensusDay';

    /**
     * The year in which the holiday was established
     */
    private const ESTABLISHMENT_YEAR = 2002;

    /**
     * Tests the holiday defined in this test on establishment.
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testHolidayOnEstablishment()
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            self::ESTABLISHMENT_YEAR,
            new DateTime(self::ESTABLISHMENT_YEAR . '-4-24', new DateTimeZone(self::TIMEZONE))
        );
        $this->assertDayOfWeek(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR, 'Wednesday');
    }

    /**
     * Tests the holiday defined in this test before establishment.
     *
     * @throws ReflectionException
     */
    public function testHolidayBeforeEstablishment()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the holiday defined in this test after completion.
     *
     * @throws ReflectionException
     */
    public function testHolidayDayAfterCompletion()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(self::ESTABLISHMENT_YEAR + 1));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws ReflectionException
     */
    public function testTranslation():void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'XVII censo nacional de población y VI de vivienda']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws ReflectionException
     */
    public function testHolidayType():void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
