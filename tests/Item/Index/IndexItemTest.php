<?php

namespace League\Sitemap\Tests\Item\Index;

use League\Sitemap\Item\Index\IndexItem;
use PHPUnit_Framework_TestCase;

class IndexItemTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $exception = '\InvalidArgumentException';

    /**
     * @var string
     */
    protected $loc = 'http://google.com';

    /**
     * @var string
     */
    protected $lastmod = '2014-05-10T17:33:30+08:00';

    /**
     * @var IndexItem
     */
    protected $item;


    public function testItShouldThrowExceptionOnChangeFreq()
    {
        $this->setExpectedException($this->exception);
        $this->item->setChangeFreq('always');
    }


    public function testItShouldThrowExceptionOnPriority()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPriority(0.1);
    }



    public function testItShouldOutputLastMod()
    {
        $this->item->setLastMod($this->lastmod);
        $this->assertContains('<lastmod>' . $this->lastmod . '</lastmod>', $this->item->build());
    }


    public function testItShouldOutputLastModAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setLastMod('a');
    }


    public function testItShouldOutputLocAndThrowException()
    {
        $this->setExpectedException($this->exception);
        new IndexItem('aaaa');
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->item = new IndexItem($this->loc);
    }
}
