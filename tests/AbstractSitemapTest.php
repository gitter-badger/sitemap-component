<?php
namespace League\Sitemap\Tests;

use PHPUnit_Framework_TestCase;

class AbstractSitemapTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var string
     */
    protected $sitemapFile = 'sitemap.xml';


    public function testItShouldThrowExceptionWhenAddWithInvalidUrl()
    {
        $sitemap = new DummyAbstractSitemap('.', $this->sitemapFile, false);

        $this->setExpectedException('\InvalidArgumentException');
        $sitemap->add('dummy', 'not-a-url');
    }


    public function testItShouldWriteXmlFile()
    {
        $sitemap = new DummyAbstractSitemap('.', $this->sitemapFile, false);
        $sitemap->build();

        $this->assertFileExists($this->sitemapFile);
    }


    public function testItShouldWriteGZipFile()
    {
        $sitemap = new DummyAbstractSitemap('.', $this->sitemapFile, true);
        $sitemap->build();

        $this->assertFileExists($this->sitemapFile.'.gz');
    }


    public function testItShouldThrowExceptionIfFilePathDoesNotExist()
    {
        $this->setExpectedException(
            'League\Sitemap\FileSystemException',
            'Provided path \'i/do/not/exist\' does not exist or is not writable.'
        );
        new DummyAbstractSitemap('i/do/not/exist', $this->sitemapFile, false);
    }


    public function testItShouldThrowExceptionIfFilePathIsNotWritable()
    {
        $this->setExpectedException(
            'League\Sitemap\FileSystemException',
            'Provided path \'/\' does not exist or is not writable.'
        );
        new DummyAbstractSitemap('/', $this->sitemapFile, false);
    }


    public function testItShouldThrowExceptionWhenFileAlreadyExists()
    {
        touch($this->sitemapFile);

        $this->setExpectedException('League\Sitemap\SitemapFileExistsException');
        new DummyAbstractSitemap('.', $this->sitemapFile, false);
    }

    /**
     *
     */
    protected function tearDown()
    {
        $fileNames = [
            $this->sitemapFile,
            $this->sitemapFile.'.gz'
        ];

        foreach ($fileNames as $fileName) {
            if (file_exists($fileName)) {
                unlink($fileName);
            }
        }
    }
}
