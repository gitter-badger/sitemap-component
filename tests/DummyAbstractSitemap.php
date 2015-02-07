<?php
namespace League\Sitemap\Tests;

use League\Sitemap\AbstractSitemap;
use League\Sitemap\SitemapException;

class DummyAbstractSitemap extends AbstractSitemap
{
    /**
     * @return string
     */
    protected function getFooter()
    {
        return 'footer';
    }

    /**
     * @return string
     */
    protected function getHeader()
    {
        return 'header';
    }

    /**
     * @return mixed|void
     */
    public function build()
    {
        $this->createNewFilePointer();
        parent::build();
    }

    /**
     * @param $item
     *
     * @throws SitemapException
     */
    protected function validateItemClassType($item)
    {
        return;
    }

    /**
     * @param        $item
     * @param string $url
     *
     * @return $this|mixed
     */
    public function add($item, $url = '')
    {
        $this->validateLoc($url);
        return $this;
    }
}
