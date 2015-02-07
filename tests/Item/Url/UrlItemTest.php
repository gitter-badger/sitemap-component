<?php

namespace League\Sitemap\Tests\Item\Url;

use League\Sitemap\Item\Url\UrlItem;
use PHPUnit_Framework_TestCase;

class UrlItemTest extends PHPUnit_Framework_TestCase
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
     * @var UrlItem
     */
    protected $item;


    public function testItShouldOutputChangeFreqAlways()
    {
        $this->item->setChangeFreq('always');
        $this->assertContains('<changefreq>always</changefreq>', $this->item->build());
    }


    public function testItShouldOutputChangeFreqNever()
    {
        $this->item->setChangeFreq('never');
        $this->assertContains('<changefreq>never</changefreq>', $this->item->build());
    }


    public function testItShouldOutputChangeFreqHourly()
    {
        $this->item->setChangeFreq('hourly');
        $this->assertContains('<changefreq>hourly</changefreq>', $this->item->build());
    }


    public function testItShouldOutputChangeFreqDaily()
    {
        $this->item->setChangeFreq('daily');
        $this->assertContains('<changefreq>daily</changefreq>', $this->item->build());
    }


    public function testItShouldOutputChangeFreqMonthly()
    {
        $this->item->setChangeFreq('monthly');
        $this->assertContains('<changefreq>monthly</changefreq>', $this->item->build());
    }


    public function testItShouldOutputChangeFreqYearly()
    {
        $this->item->setChangeFreq('yearly');
        $this->assertContains('<changefreq>yearly</changefreq>', $this->item->build());
    }


    public function testItShouldOutputChangeFreqAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setChangeFreq('aaaaa');
    }


    public function testItShouldOutputPriorityValid1()
    {
        $this->item->setPriority(0.1);
        $this->assertContains('<priority>0.1</priority>', $this->item->build());
    }


    public function testItShouldOutputPriorityValid2()
    {
        $this->item->setPriority(0.9);
        $this->assertContains('<priority>0.9</priority>', $this->item->build());
    }


    public function testItShouldOutputPriorityAndThrowException1()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPriority(10.5);
    }


    public function testItShouldOutputPriorityAndThrowException2()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPriority(-0.1);
    }


    public function testItShouldOutputPriorityAndNotPrintPriority()
    {
        $this->item->setPriority(1.0);
        $this->assertNotContains('<priority>1</priority>', $this->item->build());
        $this->assertNotContains('<priority>1.0</priority>', $this->item->build());
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
        new UrlItem('aaaa');
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->item = new UrlItem($this->loc);
    }
}
