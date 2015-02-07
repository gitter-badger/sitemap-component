<?php

namespace League\Sitemap\Tests\Item\Image;

use League\Sitemap\Item\Image\ImageItem;
use PHPUnit_Framework_TestCase;

class ImageItemTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ImageItem
     */
    protected $item;

    /**
     * @var string
     */
    protected $loc = 'http://www.example.com/logo.png';

    /**
     * @var string
     */
    protected $exception = '\InvalidArgumentException';

    /**
     *
     */
    protected function setUp()
    {
        $this->item = new ImageItem($this->loc);
    }


    public function testItShouldHaveLoc()
    {
        $this->item->setTitle('Example.com 1 logo');

        $this->assertContains(
            '<image:loc>http://www.example.com/logo.png</image:loc>',
            $this->item->build()
        );
    }


    public function testItShouldHaveTitle()
    {
        $this->item->setTitle('Example.com 1 logo');

        $this->assertContains(
            '<image:title><![CDATA[Example.com 1 logo]]></image:title>',
            $this->item->build()
        );
    }


    public function testItShouldHaveGeolocation()
    {
        $this->item->setGeoLocation('Limerick, Ireland');
        $this->assertContains(
            '<image:geolocation><![CDATA[Limerick, Ireland]]></image:geolocation>',
            $this->item->build()
        );
    }


    public function testItShouldHaveLicense()
    {
        $this->item->setLicense('MIT');

        $this->assertContains(
            '<image:license><![CDATA[MIT]]></image:license>',
            $this->item->build()
        );
    }


    public function testItShouldHaveCaption()
    {
        $this->item->setCaption('This place is called Limerick, Ireland');

        $this->assertContains(
            '<image:caption><![CDATA[This place is called Limerick, Ireland]]></image:caption>',
            $this->item->build()
        );
    }


    public function testItShouldOutputLocAndThrowException()
    {
        $this->setExpectedException($this->exception);
        new ImageItem('aaaa');
    }


    public function testItShouldValidateGeolocationInvalidInput()
    {
        $this->setExpectedException($this->exception);
        $geolocation = new \StdClass();
        $result      = $this->item->setGeoLocation($geolocation);
        $this->assertFalse($result);
    }


    public function testItShouldValidateLicense()
    {
        $this->setExpectedException($this->exception);
        $license = new \StdClass();
        $result  = $this->item->setLicense($license);
        $this->assertFalse($result);
    }


    public function testItShouldValidateCaptionInvalidInput()
    {
        $this->setExpectedException($this->exception);
        $caption = new \StdClass();
        $result  = $this->item->setCaption($caption);
        $this->assertFalse($result);
    }


    public function testItShouldValidateTitleInvalidInput()
    {
        $this->setExpectedException($this->exception);
        $title  = new \StdClass();
        $result = $this->item->setTitle($title);
        $this->assertFalse($result);
    }
}
