<?php

namespace Doofinder\FeedCompatibility\Test\Unit;

use Magento\Framework\TestFramework\Unit\BaseTestCase;

/**
 * Class Base
 * The proxy class for compatibility between different PHP versions
 */
abstract class Base extends BaseTestCase
{
    /**
     * A replace method for setUp().
     * Use this method to configure tests instead of setUp()
     * @return void
     */
    protected abstract function setupTests();

    /**
     * Simply execute setupTests() method
     * This is for compatibility between different PHPUnit and PHP versions
     */
    protected function setUp() : void
    {
        parent::setUp();
        $this->setupTests();
    }
}
