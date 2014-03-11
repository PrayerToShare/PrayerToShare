<?php

namespace PrayerToShare\Bundle\CoreBundle\Tests;

use Faker\Factory;

abstract class PrayerToShareTest extends \PHPUnit_Framework_TestCase
{
    private $faker;

    protected function setUp()
    {
        parent::setUp();

        $this->faker = Factory::create();
    }

    protected function buildMock($class, array $methods = array())
    {
        return $this->getMockBuilder($class)
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();
    }

    protected function getFaker()
    {
        return $this->faker;
    }
}
