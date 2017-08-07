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

namespace Yasumi\Provider\Chile;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\Provider\Chile;
use Yasumi\Provider\ChristianHolidays;

/**
 * Provider for all holidays in Arica and Parinacota (Chile).
 *
 * The XV Arica and Parinacota Region (Spanish: XV Región de Arica y Parinacota) is one of Chile's 15 first order
 * administrative divisions. It borders Peru to the north, Bolivia to the east and Chile's Tarapacá Region to the
 * south. It is also the country's newest region, created under Law No. 20,175. It became operational on
 * October 8, 2007.
 *
 * @link https://en.wikipedia.org/wiki/Arica_y_Parinacota_Region
 */
class AricaAndParinacota extends Chile
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'CL-AP';

    /**
     * Initialize holidays for Arica and Parinacota (Chile).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function initialize()
    {
        parent::initialize();

        // Calculate other holidays
        $this->calculateBattleOfArica();
    }

    /**
     * Calculates the anniversary of the Battle of Arica
     *
     * The Battle of Arica, also known as Assault and Capture of Cape Arica, was a battle in the War of the Pacific.
     * It was fought on 7 June 1880, between the forces of Chile and Peru. Since 2013 it is celebrated annualy only in
     * the region of Arica and Parinacota.
     *
     * @link https://en.wikipedia.org/wiki/Battle_of_Arica
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateBattleOfArica()
    {
        if ($this->year >= 2013) {
            $this->addHoliday(new Holiday('battleOfArica',
                ['es_CL' => 'Aniversario del Asalto y Toma del Morro de Arica'],
                new DateTime("$this->year-6-7", new DateTimeZone($this->timezone)), $this->locale));
        }
    }
}
