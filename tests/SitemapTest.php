<?php
namespace League\Sitemap\Tests;

use League\Sitemap\Item\Url\UrlItem;
use League\Sitemap\Sitemap;
use PHPUnit_Framework_TestCase;

class SitemapTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Sitemap
     */
    protected $siteMap;

    /**
     * @var string
     */
    protected $exception = '\InvalidArgumentException';


    public function testItShouldThrowExceptionIfItemIsNotOfUrlItem()
    {
        $this->setExpectedException($this->exception);
        $item = 'not a valid item';
        $this->siteMap->add($item);
    }


    public function testItShouldCreateOneSiteMapFile()
    {
        for ($i = 0; $i < 20; $i++) {
            $this->addToSiteMap($i);
        }
        $this->siteMap->build();

        $this->assertFileExists('sitemaptest.xml');
        $sitemap = file_get_contents('sitemaptest.xml');

        $this->assertContains('http://www.example.com/0', $sitemap);
        $this->assertContains('http://www.example.com/19', $sitemap);
        $this->assertContains(
            '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n",
            $sitemap
        );
        $this->assertContains('</urlset>', $sitemap);
    }

    /**
     * @param $i
     */
    protected function addToSiteMap($i)
    {
        $item = new UrlItem('http://www.example.com/' . $i);
        $item->setPriority('1.0');
        $item->setChangeFreq('daily');
        $item->setLastMod('2014-05-10T17:33:30+08:00');

        $this->siteMap->add($item);
    }


    public function testItShouldCreateTwoSiteMapFiles()
    {
        for ($i = 0; $i < 50020; $i++) {
            $this->addToSiteMap($i);
        }
        $this->siteMap->build();

        $this->assertFileExists('sitemaptest.xml');
        $sitemap1 = file_get_contents('sitemaptest.xml');
        $this->assertContains('http://www.example.com/0', $sitemap1);
        $this->assertContains('http://www.example.com/49999', $sitemap1);

        $this->assertFileExists('sitemaptest1.xml');
        $sitemap2 = file_get_contents('sitemaptest1.xml');
        $this->assertContains('http://www.example.com/50000', $sitemap2);
        $this->assertContains('http://www.example.com/50019', $sitemap2);
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->tearDown();
        $this->siteMap = new Sitemap('.', 'sitemaptest.xml', false);
    }

    /**
     *
     */
    protected function tearDown()
    {
        $fileNames = ['sitemaptest.xml', 'sitemaptest1.xml'];

        foreach ($fileNames as $fileName) {
            if (file_exists($fileName)) {
                unlink($fileName);
            }
        }
    }
}
