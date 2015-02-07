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
     * @throws \InvalidArgumentException
     * @return $this|mixed
     */
    public function add($item, $url = '')
    {
        if (false === $this->validateLoc($url)) {
            throw new \InvalidArgumentException(sprintf('Provided url is not valid.'));
        }

        return $this;
    }
}
