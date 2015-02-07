<?php
namespace League\Sitemap\Tests;

use League\Sitemap\Item\Media\MediaItem;
use League\Sitemap\MediaSitemap;
use PHPUnit_Framework_TestCase;


class MediaSitemapTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var MediaSitemap
     */
    protected $siteMap;

    /**
     * @var string
     */
    protected $exception = '\InvalidArgumentException';


    public function testItShouldThrowExceptionIfItemIsNotOfMediaItem()
    {
        $this->setExpectedException($this->exception);
        $item = 'not a valid item';
        $this->siteMap->add($item);
    }


    public function testItShouldThrowExceptionSitemapChannelDescriptionIsNotValid()
    {
        $this->setExpectedException($this->exception);
        $this->siteMap->setDescription('');
    }


    public function testItShouldThrowExceptionSitemapChannelTitleIsNotValid()
    {
        $this->setExpectedException($this->exception);
        $this->siteMap->setTitle('');
    }


    public function testItShouldThrowExceptionSitemapChannelLinkIsNotValid()
    {
        $this->setExpectedException($this->exception);
        $this->siteMap->setLink('');
    }


    public function testItShouldCreateOneSiteMapFile()
    {
        $this->siteMap->setDescription('This is a description');
        $this->siteMap->setTitle('This is a title');
        $this->siteMap->setLink('http://example.com/channel');

        for ($i = 0; $i < 20; $i++) {
            $item = new MediaItem('http://www.example.com/'.$i);
            $this->siteMap->add($item);
        }
        $this->siteMap->build();

        $this->assertFileExists('sitemaptest.xml');
        $sitemap = file_get_contents('sitemaptest.xml');

        $this->assertContains('<description>This is a description</description>', $sitemap);
        $this->assertContains('<title>This is a title</title>', $sitemap);
        $this->assertContains('<link>http://example.com/channel</link>', $sitemap);
        $this->assertContains('http://www.example.com/0', $sitemap);
        $this->assertContains('http://www.example.com/19', $sitemap);
        $this->assertContains(
            '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
            '<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">'
            . "\n" . '<channel>',
            $sitemap
        );
        $this->assertContains('</channel>', $sitemap);
        $this->assertContains('</rss>', $sitemap);
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->tearDown();
        $this->siteMap = new MediaSitemap('.', 'sitemaptest.xml', false);
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
