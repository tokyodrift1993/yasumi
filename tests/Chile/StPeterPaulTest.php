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
 * Class for testing the Feast of Saints Peter and Paul (San Pedro y San Pablo) in Chile.
 */
class StPeterPaulDayTest extends ChileBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'stPeterPaulsDay';

    /**
     * Tests the holiday defined in this test.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int       $year     the year for which the holiday defined in this test needs to be tested
     * @param \DateTime $expected the expected date
     */
    public function testHoliday($year, $expected)
    {
        $date = new DateTime($expected, new DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);

        // Law 19,668 declares certain holidays that fall on Tuesday, Wednesday or Thursday are observed the
        // preceding Monday. If the holiday falls on a Friday, the following Monday is the day of observance.
        if ($year >= 2000) {
            if (in_array((int)$date->format('w'), [2, 3, 4], true)) {
                $date->modify('previous monday');
            } elseif (5 === (int)$date->format('w')) {
                $date->modify('next monday');
            }

            $this->assertHoliday(self::REGION, 'substituteHoliday:' . self::HOLIDAY, $year, $date);
            $this->assertTranslatedHolidayName(self::REGION, 'substituteHoliday:' . self::HOLIDAY, $year,
                ['es_CL' => 'San Pedro y San Pablo']);
        }
    }

    /**
     * Returns a list of random test dates used for assertion of the holiday defined in this test
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider()
    {
        $data = [];

        for ($y = 0; $y < self::TEST_ITERATIONS; $y++) {
            $year   = $this->generateRandomYear();
            $date   = new DateTime("$year-6-29", new DateTimeZone(self::TIMEZONE));
            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }

    /**
     * Tests translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            [self::LOCALE => 'San Pedro y San Pablo']);
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_NATIONAL);
    }
}
