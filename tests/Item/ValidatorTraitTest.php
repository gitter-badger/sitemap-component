<?php

namespace itShoulds\League\Sitemap\Item;

use League\Sitemap\Item\ValidatorTrait;
use PHPUnit_Framework_TestCase;

class ValidatorTraitTest extends PHPUnit_Framework_TestCase
{
    use ValidatorTrait;

    public function __construct()
    {
    }


    public function testItShouldValidateLoc()
    {
        $result = $this->validateLoc('http://google.com/news');
        $this->assertEquals('http://google.com/news', $result);
    }


    public function testItShouldNotValidateLoc()
    {
        $result = $this->validateLoc('not-a-url');
        $this->assertEquals(false, $result);
    }


    public function testItShouldValidateDateValidFormat1()
    {
        $date   = new \DateTime('now');
        $date   = $date->format('c');
        $result = $this->validateDate($date);

        $this->assertEquals($date, $result);
    }


    public function testItShouldValidateDateValidFormat2()
    {
        $date   = new \DateTime('now');
        $date   = $date->format('Y-m-d\TH:i:sP');
        $result = $this->validateDate($date);

        $this->assertEquals($date, $result);
    }


    public function testItShouldValidateDateValidFormat3()
    {
        $date   = new \DateTime('now');
        $date   = $date->format('Y-m-d');
        $result = $this->validateDate($date);

        $this->assertEquals($date, $result);
    }


    public function testItShouldValidateDateInvalidFormat()
    {
        $date   = '2A-13-03';
        $result = $this->validateDate($date);

        $this->assertEquals(false, $result);
    }
}
