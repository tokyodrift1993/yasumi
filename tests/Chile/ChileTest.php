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
use Yasumi\Holiday;

/**
 * Class for testing holidays in Chile.
 */
class ChileTest extends ChileBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all national holidays in Chile are defined by the provider class
     */
    public function testNationalHolidays()
    {
        $nationalHolidays = ['newYearsDay', 'goodFriday', 'stPeterPaulsDay'];

        if ($this->year >= 1932) {
            $nationalHolidays[] = 'internationalWorkersDay';
        }

        if ($this->year === 1982) {
            $nationalHolidays[] = '1982CensusDay';
        }

        if ($this->year === 1992) {
            $nationalHolidays[] = '1992CensusDay';
        }

        if ($this->year === 2002) {
            $nationalHolidays[] = '2002CensusDay';
        }

        if ($this->year === 2017) {
            $nationalHolidays[] = '2017CensusDay';
        }

        if ($this->year >= 1915) {
            $nationalHolidays[] = 'navyDay';
        }

        $this->assertDefinedHolidays($nationalHolidays, self::REGION, $this->year, Holiday::TYPE_NATIONAL);
    }

    /**
     * Tests if all observed holidays in Chile are defined by the provider class
     */
    public function testObservedHolidays()
    {
        $observedHolidays = ['holySaturday'];

        // Law 20,983 declares a holiday on days that are Monday January 2 (2017 going forward)
        if ($this->year >= 2017) {
            $new_years_day = new DateTime("$this->year-1-1");
            if ($new_years_day->format('w') === 0) {
                $observedHolidays[] = 'substituteHoliday:newYearsDay';
            }
        }

        $this->assertDefinedHolidays($observedHolidays, self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Chile are defined by the provider class
     */
    public function testSeasonalHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Chile are defined by the provider class
     */
    public function testBankHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Chile are defined by the provider class
     */
    public function testOtherHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /**
     * Initial setup of this Test Case
     */
    protected function setUp()
    {
        $this->year = $this->generateRandomYear(1000);
    }
}
