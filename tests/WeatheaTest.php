<?php

namespace maxiao\Weather\Tests;

use maxiao\Weather\Exceptions\InvaildArgumentException;
use maxiao\Weather\Weather;
use PHPUnit\Framework\TestCase;

class WeatheaTest extends TestCase
{
    public function testGetWeather()
    {

    }

    public function testGetHttpClient()
    {

    }

    public function testSetGuzzleOptinos()
    {

    }

    public function testGetWeatherWithInvalidType()
    {
         $w = new Weather('mock-key');
         $this->expectException(InvaildArgumentException::class);
         $this->expectExceptionMessage('Invalid type value(base/all): foo');
         $w->getWeather('深圳','foo');

         $this->fail('Failed to assert getWeather throw exception with invalid argument.');
    }
}




















