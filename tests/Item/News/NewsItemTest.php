<?php
namespace League\Sitemap\Tests\Item\News;

use League\Sitemap\Item\News\NewsItem;
use PHPUnit_Framework_TestCase;

class NewsItemTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $language = 'en';

    /**
     * @var string
     */
    protected $name = 'The Example Times';

    /**
     * @var string
     */
    protected $date = '2008-12-23';

    /**
     * @var string
     */
    protected $title = 'Companies A, B in Merger Talks';

    /**
     * @var string
     */
    protected $loc = 'http://www.example.org/business/article55.html';

    /**
     * @var NewsItem
     */
    protected $item;

    /**
     * @var string
     */
    protected $exception = '\InvalidArgumentException';


    public function testItShouldThrowExceptionForLoc()
    {
        $this->setExpectedException($this->exception);
        $this->item = new NewsItem(
            null,
            $this->title,
            $this->date,
            $this->name,
            $this->language
        );
    }


    public function testItShouldThrowExceptionForTitle()
    {
        $this->setExpectedException($this->exception);
        $this->item = new NewsItem(
            $this->loc,
            null,
            $this->date,
            $this->name,
            $this->language
        );
    }


    public function testItShouldThrowExceptionForDate()
    {
        $this->setExpectedException($this->exception);
        $this->item = new NewsItem(
            $this->loc,
            $this->title,
            null,
            $this->name,
            $this->language
        );
    }


    public function testItShouldThrowExceptionForPublicationName()
    {
        $this->setExpectedException($this->exception);
        $this->item = new NewsItem(
            $this->loc,
            $this->title,
            $this->date,
            null,
            $this->language
        );
    }


    public function testItShouldThrowExceptionForLanguage()
    {
        $this->setExpectedException($this->exception);
        $this->item = new NewsItem(
            $this->loc,
            $this->title,
            $this->date,
            $this->title,
            null
        );
    }


    public function testItShouldHaveAccess()
    {
        $this->item->setAccess('Subscription');
        $this->assertContains(
            '<news:access>Subscription</news:access>',
            $this->item->build()
        );

        $this->item->setAccess('Registration');
        $this->assertContains(
            '<news:access>Registration</news:access>',
            $this->item->build()
        );
    }


    public function testItShouldHaveAccessAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setAccess(null);
    }


    public function testItShouldHaveKeywords()
    {
        $this->item->setKeywords('business, merger, acquisition, A, B');
        $this->assertContains(
            '<news:keywords>business, merger, acquisition, A, B</news:keywords>',
            $this->item->build()
        );
    }


    public function testItShouldHaveKeywordsAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setKeywords(null);
    }


    public function testItShouldHaveStockTickers()
    {
        $this->item->setStockTickers('NASDAQ:A, NASDAQ:B');
        $this->assertContains(
            '<news:stock_tickers>NASDAQ:A, NASDAQ:B</news:stock_tickers>',
            $this->item->build()
        );
    }


    public function testItShouldHaveStockTickersAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setStockTickers(null);
    }


    public function testItShouldHaveGenres()
    {
        $this->item->setGenres('PressRelease, Blog');
        $this->assertContains(
            '<news:genres>PressRelease, Blog</news:genres>',
            $this->item->build()
        );
    }


    public function testItShouldHaveGenresAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setGenres(null);
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->item = new NewsItem(
            $this->loc,
            $this->title,
            $this->date,
            $this->name,
            $this->language
        );
    }
}
