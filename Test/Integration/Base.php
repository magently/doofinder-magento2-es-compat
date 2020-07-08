<?php

namespace Doofinder\FeedCompatibility\Test\Integration;

use Magento\TestFramework\TestCase\AbstractIntegrity;

/**
 * Class Base
 * The proxy class for compatibility between different PHP versions
 */
abstract class Base extends AbstractIntegrity
{
    /**
     * A replace method for setUp().
     * Use this method to configure tests instead of setUp()
     * @return void
     */
    protected abstract function setupTests();

    /**
     * Simply execute setupTests() method
     * This method in PHPUnit 9 has return type set to void
     * which is not working with PHP 7.0
     */
    protected function setUp()
    {
        parent::setUp();
        $this->setupTests();
    }
}
