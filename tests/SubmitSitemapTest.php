<?php
namespace League\Sitemap\Tests;

use League\Sitemap\SubmitSitemap;
use PHPUnit_Framework_TestCase;

class SubmitSitemapTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $url = 'http://elmundo.feedsportal.com/elmundo/rss/portada.xml';

    /**
     * @var string
     */
    protected $exception = '\InvalidArgumentException';


    public function testItShouldSubmitValidSitemapUrl()
    {
        $result = SubmitSitemap::send($this->url);
        $expected = ['google' => true, 'bing' => true];

        $this->assertNotEmpty($result);
        $this->assertEquals($expected, $result);
    }


    public function testItShouldSubmitValidSitemapNonValidUrl()
    {
        $this->setExpectedException($this->exception);
        SubmitSitemap::send('not a valid url');
    }
}
