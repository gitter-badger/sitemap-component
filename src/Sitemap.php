<?php
namespace League\Sitemap;

use League\Sitemap\Item\Url\UrlItem;

class Sitemap extends AbstractSitemap
{
    /**
     * Adds a new sitemap item.
     *
     * @param $item
     * @param string  $url
     *
     * @return $this
     */
    public function add($item, $url = '')
    {
        $this->validateItemClassType($item);
        $this->createSitemapFile();

        $xmlData = $item->build();
        if (false === $this->isNewFileIsRequired() && false === $this->isSurpassingFileSizeLimit($xmlData)) {
            $this->appendToFile($xmlData);
            $this->totalItems++;
            return $this;
        }

        $this->createAdditionalSitemapFile($item);

        return $this;
    }

    /**
     * @param $item
     *
     * @throws \InvalidArgumentException
     */
    protected function validateItemClassType($item)
    {
        if (!($item instanceof UrlItem)) {
            throw new \InvalidArgumentException(
                "Provided \$item is not instance of \\League\\Sitemap\\Item\\Url\\UrlItem."
            );
        }
    }

    /**
     * @return string
     */
    protected function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    }

    /**
     * @return string
     */
    protected function getFooter()
    {
        return "</urlset>";
    }
}
