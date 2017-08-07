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
     *
     * @throws \InvalidArgumentException
     */
    public function initialize()
    {
        $this->timezone = 'America/Santiago';

        // Add common holidays
        $this->calculateNewYearsDay();
        $this->calculateInternationalWorkersDay();

        // Add common Christian holidays (common in Chile)
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->holySaturday($this->year, $this->timezone, $this->locale));
        $this->calculatestPeterPaulsDay();

        // Calculate other holidays
        $this->calculateCensusDay1982();
        $this->calculateCensusDay1992();
        $this->calculateCensusDay2002();
        $this->calculateCensusDay2017();
        $this->calculateNavyDay();
    }

    /**
     * New Year's Day is celebrated on January 1st. Law 20,983 declares a holiday on days that are Monday January 2
     * (2017 going forward).
     *
     * @link https://www.timeanddate.com/holidays/chile/new-year-day
     * @link https://www.leychile.cl/Navegar?idNorma=1098384&idParte=&idVersion=2016-12-30
     *
     * @throws \InvalidArgumentException
     */
    private function calculateNewYearsDay()
    {
        // Add regular New Years Day Holiday
        $holiday = $this->newYearsDay($this->year, $this->timezone, $this->locale);
        $this->addHoliday($holiday);

        // Law 20,983 declares a holiday on days that are Monday January 2 (2017 going forward)
        if ($this->year >= 2017 && (0 === (int)$holiday->format('w'))) {
            $substituteHoliday = clone $holiday;
            $substituteHoliday->modify('next monday');

            $this->addHoliday(new Holiday('substituteHoliday:' . $substituteHoliday->shortName, [
                'es_CL' => 'San Lunes',
            ], $substituteHoliday, $this->locale));
        }
    }

    /**
     * 1982 Census
     *
     * Censuses, held every ten years, are also declared holidays since 1982; that year's census and 1992's were so due
     * to ad-hoc laws; censuses taken from 1992 onwards are declared holidays due to a reform in the Census law.
     * (This did not occur in 2012, where the census was carried out in the space of two months, using a different
     * methodology.)
     *
     * @link https://en.wikipedia.org/wiki/Public_holidays_in_Chile#cite_note-30
     * @link http://www.feriadoschilenos.cl/index.html#singular.21.04.1982
     *
     * @throws \InvalidArgumentException
     */
    private function calculateCensusDay1982()
    {
        if ($this->year !== 1982) {
            return;
        }

        $this->addHoliday(new Holiday(
            '1982CensusDay',
            ['es_CL' => 'XV censo nacional de población y IV de vivienda'],
            new DateTime('1982-4-21', new DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * 1992 Census
     *
     * Censuses, held every ten years, are also declared holidays since 1982; that year's census and 1992's were so due
     * to ad-hoc laws; censuses taken from 1992 onwards are declared holidays due to a reform in the Census law.
     * (This did not occur in 2012, where the census was carried out in the space of two months, using a different
     * methodology.)
     *
     * @link https://en.wikipedia.org/wiki/Public_holidays_in_Chile#cite_note-30
     * @link http://www.feriadoschilenos.cl/index.html#singular.22.04.1992
     *
     * @throws \InvalidArgumentException
     */
    private function calculateCensusDay1992()
    {
        if ($this->year !== 1992) {
            return;
        }

        $this->addHoliday(new Holiday(
            '1992CensusDay',
            ['es_CL' => 'XVI censo nacional de población y V de vivienda'],
            new DateTime('1992-4-22', new DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * 2002 Census
     *
     * Censuses, held every ten years, are also declared holidays since 1982; that year's census and 1992's were so due
     * to ad-hoc laws; censuses taken from 1992 onwards are declared holidays due to a reform in the Census law.
     * (This did not occur in 2012, where the census was carried out in the space of two months, using a different
     * methodology.)
     *
     * @link https://en.wikipedia.org/wiki/Public_holidays_in_Chile#cite_note-30
     * @link http://www.feriadoschilenos.cl/index.html#singular.24.04.2002
     *
     * @throws \InvalidArgumentException
     */
    private function calculateCensusDay2002()
    {
        if ($this->year !== 2002) {
            return;
        }

        $this->addHoliday(new Holiday(
            '2002CensusDay',
            ['es_CL' => 'XVII censo nacional de población y VI de vivienda'],
            new DateTime('2002-4-24', new DateTimeZone($this->timezone)),
            $this->locale
        ));
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
     *
     * @throws \InvalidArgumentException
     */
    private function calculateCensusDay2017()
    {
        if ($this->year !== 2017) {
            return;
        }

        $this->addHoliday(new Holiday(
            '2017CensusDay',
            ['es_CL' => 'Censo abreviado 2017'],
            new DateTime('2017-4-19', new DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * International Workers Day
     *
     * The DFL 178 of 1931 of the Ministry of Social Welfare instituted Labor Day (International Workers Day) as an
     * official recurring holiday (effective from 1932).
     *
     * @link http://www.feriadoschilenos.cl/index.html#DiaNacionalDelTrabajo
     *
     * @throws \InvalidArgumentException
     */
    private function calculateInternationalWorkersDay()
    {
        if ($this->year < 1932) {
            return;
        }

        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
    }

    /**
     * Navy Day (Día de las Glorias Navales)
     *
     * Navy Day is a Chilean national holiday (Spanish: Día de las Glorias Navales, literally Day of Naval Glories)
     * celebrated on May 21 each year. The day was selected to commemorate the Battle of Iquique, which occurred on
     * Wednesday, May 21, 1879 during the War of the Pacific. The day is an office holiday and the traditional day for
     * the Annual Statement of the President of the Republic of Chile.
     *
     * @link https://en.wikipedia.org/wiki/Navy_Day_(Chile)
     * @link http://www.feriadoschilenos.cl/index.html#DiaDeLasGloriasNavales
     * @throws \InvalidArgumentException
     */
    private function calculateNavyDay()
    {
        if ($this->year < 1915) {
            return;
        }

        $this->addHoliday(new Holiday(
            'navyDay',
            ['es_CL' => 'Día de las Glorias Navales'],
            new DateTime("$this->year-5-21", new DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * The Feast of Saints Peter and Paul is a liturgical feast in honour of the martyrdom in Rome of the apostles
     * Saint Peter and Saint Paul, which is observed on 29 June.
     *
     * Law 19,668 declares certain holidays that fall on Tuesday, Wednesday or Thursday are observed the
     * preceding Monday. If the holiday falls on a Friday, the following Monday is the day of observance.
     *
     * @link https://www.timeanddate.com/holidays/chile/saint-peter-and-saint-paul
     * @link https://www.leychile.cl/Navegar?idNorma=160270
     *
     * @throws \InvalidArgumentException
     */
    private function calculatestPeterPaulsDay()
    {
        // Add regular New Years Day Holiday
        $holiday = $this->stPeterPaulsDay($this->year, $this->timezone, $this->locale);
        $this->addHoliday($holiday);

        if ($this->year >= 2000) {
            $substituteHoliday = clone $holiday;

            if (in_array((int)$holiday->format('w'), [2, 3, 4], true)) {
                $substituteHoliday->modify('previous monday');
            } elseif (5 === (int)$holiday->format('w')) {
                $substituteHoliday->modify('next monday');
            }

            $this->addHoliday(new Holiday('substituteHoliday:' . $substituteHoliday->shortName, [
                'es_CL' => 'San Pedro y San Pablo',
            ], $substituteHoliday, $this->locale));
        }
    }
}
