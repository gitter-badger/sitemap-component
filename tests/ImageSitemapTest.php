<?php
namespace League\Sitemap\Tests;

use League\Sitemap\ImageSitemap;
use League\Sitemap\Item\Image\ImageItem;
use PHPUnit_Framework_TestCase;


class ImageSitemapTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ImageSitemap
     */
    protected $siteMap;

    /**
     * @var string
     */
    protected $exception = '\InvalidArgumentException';


    public function testItShouldThrowExceptionIfItemIsNotOfImageItem()
    {
        $this->setExpectedException($this->exception);
        $item = 'not a valid item';
        $this->siteMap->add($item);
    }


    public function testItShouldCreateOneSiteMapFile()
    {
        for ($i = 0; $i < 20; $i++) {
            $item = new ImageItem('http://www.example.com/' . $i.'.jpg');
            $this->siteMap->add($item, 'http://www.example.com/gallery-1.html');
        }
        $this->siteMap->build();

        $this->assertFileExists('sitemaptest.xml');
        $sitemap = file_get_contents('sitemaptest.xml');

        $this->assertContains('http://www.example.com/gallery-1.html', $sitemap);
        $this->assertContains('http://www.example.com/0.jpg', $sitemap);
        $this->assertContains('http://www.example.com/19.jpg', $sitemap);
        $this->assertContains(
            '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" ' .
            'xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">',
            $sitemap
        );
        $this->assertContains('</urlset>', $sitemap);
    }



    public function testItShouldCreateTwoSiteMapFiles()
    {
        $j = 1;
        $url = 'http://www.example.com/gallery-' . $j .'.html';

        for ($i = 0; $i < 50020; $i++) {
            if (0 === $i % 1001) {
                $url = 'http://www.example.com/gallery-' . $j .'.html';
                $j++;
            }
            $imageUrl = 'http://www.example.com/' . $i .'.jpg';
            $item = new ImageItem($imageUrl);
            $this->siteMap->add($item, $url);
        }
        $this->siteMap->build();

        $this->assertFileExists('sitemaptest.xml');
        for ($i=1; $i<=49; $i++) {
            $this->assertFileExists('sitemaptest'.$i.'.xml');
            unlink('sitemaptest'.$i.'.xml');
        }
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->tearDown();
        $this->siteMap = new ImageSitemap('.', 'sitemaptest.xml', false);
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
