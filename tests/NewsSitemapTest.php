<?php
namespace League\Sitemap\Tests;

use League\Sitemap\Item\News\NewsItem;
use League\Sitemap\NewsSitemap;
use PHPUnit_Framework_TestCase;

class NewsSitemapTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var NewsSitemap
     */
    protected $siteMap;

    /**
     * @var string
     */
    protected $exception = '\InvalidArgumentException';


    public function testItShouldThrowExceptionIfItemIsNotOfNewsItem()
    {
        $this->setExpectedException($this->exception);
        $item = 'not a valid item';
        $this->siteMap->add($item);
    }


    public function testItShouldCreateOneSiteMapFile()
    {
        for ($i = 0; $i < 20; $i++) {
            $item = new NewsItem(
                'http://www.example.com/'.$i,
                'Companies A, B in Merger Talks',
                '2008-12-23',
                'The Example Times',
                'en'
            );

            $this->siteMap->add($item);
        }
        $this->siteMap->build();

        $this->assertFileExists('sitemaptest.xml');
        $sitemap = file_get_contents('sitemaptest.xml');

        $this->assertContains('http://www.example.com/0', $sitemap);
        $this->assertContains('http://www.example.com/19', $sitemap);
        $this->assertContains(
            '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" ' .
            'xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">' . "\n",
            $sitemap
        );
        $this->assertContains('</urlset>', $sitemap);
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->tearDown();
        $this->siteMap = new NewsSitemap('.', 'sitemaptest.xml', false);
    }

    /**
     *
     */
    protected function tearDown()
    {
        $fileNames = ['sitemaptest.xml'];

        foreach ($fileNames as $fileName) {
            if (file_exists($fileName)) {
                unlink($fileName);
            }
        }
    }
}
