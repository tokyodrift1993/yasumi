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

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Chile holiday provider.
 */
abstract class ChileBaseTestCase extends TestCase
{
    use YasumiBase;

    /**
     * Name of the region (e.g. country / state) to be tested
     */
    public const REGION = 'Chile';

    /**
     * Timezone in which this provider has holidays defined
     */
    public const TIMEZONE = 'America/Santiago';

    /**
     * Locale that is considered common for this provider
     */
    public const LOCALE = 'es_CL';

    /**
     * Number of iterations to be used for the various unit test of this provider
     */
    public const TEST_ITERATIONS = 50;
}
