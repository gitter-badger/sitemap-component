<?php
namespace League\Sitemap;

use League\Sitemap\Item\Index\IndexItem;

class IndexSitemap extends Sitemap
{
    /**
     * @param IndexItem $item
     *
     * @throws \InvalidArgumentException
     */
    protected function validateItemClassType($item)
    {
        if (!($item instanceof IndexItem)) {
            throw new \InvalidArgumentException(
                "Provided \$item is not instance of \\League\\Sitemap\\Item\\Index\\IndexItem."
            );
        }
    }

    /**
     * @return string
     */
    protected function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
        '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    }

    /**
     * @return string
     */
    protected function getFooter()
    {
        return "</sitemapindex>";
    }
}
