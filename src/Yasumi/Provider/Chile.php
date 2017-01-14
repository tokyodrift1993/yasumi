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

namespace Yasumi\Provider;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Chile.
 *
 */
class Chile extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'CL';

    /**
     * Initialize holidays for Chile.
     */
    public function initialize()
    {
        $this->timezone = 'America/Santiago';

        // Add common holidays
        $this->calculateNewYearsDay();

        // Add common Christian holidays (common in Chile)
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->holySaturday($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateCensusDay2017();
    }

    /**
     * New Year's Day is celebrated on January 1st. Law 20,983 declares a holiday on days that are Monday January 2
     * (2017 going forward).
     *
     * @link https://www.timeanddate.com/holidays/chile/new-year-day
     * @link https://www.leychile.cl/Navegar?idNorma=1098384&idParte=&idVersion=2016-12-30
     */
    public function calculateNewYearsDay()
    {
        // Add regular New Years Day Holiday
        $holiday = $this->newYearsDay($this->year, $this->timezone, $this->locale);
        $this->addHoliday($holiday);

        // Law 20,983 declares a holiday on days that are Monday January 2 (2017 going forward)
        if ($this->year >= 2017 && (0 == $holiday->format('w'))) {
            $substituteHoliday = clone $holiday;
            $substituteHoliday->modify('next monday');

            $this->addHoliday(new Holiday('substituteHoliday:' . $substituteHoliday->shortName, [
                'es_CL' => 'San Lunes',
            ], $substituteHoliday, $this->locale));
        }
    }

    /**
     * 2017 Census
     *
     * Censuses, held every ten years, are also declared holidays since 1982; that year's census and 1992's were so due
     * to ad-hoc laws; censuses taken from 1992 onwards are declared holidays due to a reform in the Census law.
     * (This did not occur in 2012, where the census was carried out in the space of two months, using a different
     * methodology.)
     *
     * Due to a number of problems with the implementation and results of the census of 2012, in June 2014 it was
     * decided to supplement it with an abbreviated census to take place on  Wednesday, April 19, 2017.
     *
     * @link https://en.wikipedia.org/wiki/Public_holidays_in_Chile#cite_note-30
     * @link http://www.feriadoschilenos.cl/#singular.19.04.2017
     */
    public function calculateCensusDay2017()
    {
        if ($this->year != 2017) {
            return;
        }

        $this->addHoliday(new Holiday('2017CensusDay', ['es_CL' => 'Censo abreviado 2017'],
            new DateTime('2017-4-19', new DateTimeZone($this->timezone)), $this->locale));
    }
}
