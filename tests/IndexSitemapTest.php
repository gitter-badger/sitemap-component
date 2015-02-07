<?php
namespace League\Sitemap\Tests;

use League\Sitemap\Item\Index\IndexItem;
use League\Sitemap\IndexSitemap;
use PHPUnit_Framework_TestCase;


class IndexSitemapTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var IndexSitemap
     */
    protected $siteMap;

    /**
     * @var string
     */
    protected $exception = '\InvalidArgumentException';


    public function testItShouldThrowExceptionIfItemIsNotOfIndexItem()
    {
        $this->setExpectedException($this->exception);
        $item = 'not a valid item';
        $this->siteMap->add($item);
    }


    public function testItShouldCreateOneSiteMapFile()
    {
        for ($i = 0; $i < 20; $i++) {
            $item = new IndexItem('http://www.example.com/'.$i);
            $this->siteMap->add($item);
        }
        $this->siteMap->build();

        $this->assertFileExists('sitemaptest.xml');
        $sitemap = file_get_contents('sitemaptest.xml');

        $this->assertContains('http://www.example.com/0', $sitemap);
        $this->assertContains('http://www.example.com/19', $sitemap);
        $this->assertContains(
            '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
            '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n",
            $sitemap
        );
        $this->assertContains('</sitemapindex>', $sitemap);
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->tearDown();
        $this->siteMap = new IndexSitemap('.', 'sitemaptest.xml', false);
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
