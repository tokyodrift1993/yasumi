<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2019 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Chile\AricaAndParinacota;

use Yasumi\tests\Chile\ChileBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Arica and Parinacota (Chile) holiday provider.
 */
abstract class AricaAndParinacotaBaseTestCase extends ChileBaseTestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    public const REGION = 'Chile/AricaAndParinacota';

    /**
     * Timezone in which this provider has holidays defined
     */
    public const TIMEZONE = 'America/Santiago';
}
