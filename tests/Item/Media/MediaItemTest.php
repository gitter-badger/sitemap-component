<?php

namespace League\Sitemap\Tests\Item\Media;

use League\Sitemap\Item\Media\MediaItem;
use PHPUnit_Framework_TestCase;

class MediaItemTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $link = 'http://www.example.com/examples/mrss/example.html';

    /**
     * @var MediaItem
     */
    protected $item;

    /**
     * @var string
     */
    protected $exception = '\InvalidArgumentException';

    /**
     *
     */
    public function setUp()
    {
        $this->item = new MediaItem($this->link);
    }



    public function testItShouldThrowException()
    {
        $this->setExpectedException($this->exception);
        new MediaItem('aaaa');
    }


    public function testItShouldHaveContent()
    {
        $this->item->setContent('video/x-flv');

        $this->assertContains(
            '<media:content type="video/x-flv">',
            $this->item->build()
        );
    }


    public function testItShouldHaveContentThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setContent(null);
    }


    public function testItShouldHaveContentAndDuration()
    {
        $this->item->setContent('video/x-flv', 120);

        $this->assertContains(
            '<media:content type="video/x-flv" duration="120">',
            $this->item->build()
        );
    }


    public function testItShouldHaveContentAndDurationThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setContent('video/x-flv', -1);
    }


    public function testItShouldHavePlayer()
    {
        $this->item->setPlayer('http://www.example.com/shows/example/video.swf?flash_params');

        $this->assertContains(
            '<media:player url="http://www.example.com/shows/example/video.swf?flash_params" />',
            $this->item->build()
        );
    }


    public function testItShouldHavePlayerAndThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPlayer('aaaaa');
    }


    public function testItShouldHaveTitle()
    {
        $this->item->setTitle('Barbacoas en verano');

        $this->assertContains(
            '<media:title>Barbacoas en verano</media:title>',
            $this->item->build()
        );
    }


    public function testItShouldHaveTitleAndThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setTitle(null);
    }


    public function testItShouldHaveDescription()
    {
        $this->item->setDescription('Consigue que los filetes queden perfectamente hechos siempre');

        $this->assertContains(
            '<media:description>Consigue que los filetes queden perfectamente hechos siempre</media:description>',
            $this->item->build()
        );
    }


    public function testItShouldHaveDescriptionAndThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setDescription(null);
    }


    public function testItShouldHaveThumbnailWithUrl()
    {
        $this->item->setThumbnail('http://www.example.com/examples/mrss/example.png');

        $this->assertContains(
            '<media:thumbnail url="http://www.example.com/examples/mrss/example.png"/>',
            $this->item->build()
        );
    }


    public function testItShouldHaveThumbnailWithUrlAndThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setThumbnail(null);
    }


    public function testItShouldHaveThumbnailWithUrlAndHeight()
    {
        $this->item->setThumbnail('http://www.example.com/examples/mrss/example.png', 120);

        $this->assertContains(
            '<media:thumbnail url="http://www.example.com/examples/mrss/example.png" height="120"/>',
            $this->item->build()
        );
    }


    public function testItShouldHaveThumbnailWithUrlAndHeightThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setThumbnail('http://www.example.com/examples/mrss/example.png', -120);
    }


    public function testItShouldHaveThumbnailWithUrlAndWidth()
    {
        $this->item->setThumbnail('http://www.example.com/examples/mrss/example.png', 120, 120);

        $this->assertContains(
            '<media:thumbnail url="http://www.example.com/examples/mrss/example.png" height="120" width="120"/>',
            $this->item->build()
        );
    }


    public function testItShouldHaveThumbnailWithUrlAndWidthThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setThumbnail('http://www.example.com/examples/mrss/example.png', 120, -120);
    }
}
