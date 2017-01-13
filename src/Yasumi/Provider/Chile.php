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

        // Calculate other holidays
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
                'es_CL' => $substituteHoliday->getName(),
            ], $substituteHoliday, $this->locale));
        }
    }
}
