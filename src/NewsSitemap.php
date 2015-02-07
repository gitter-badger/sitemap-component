<?php
namespace League\Sitemap;

use League\Sitemap\Item\News\NewsItem;

class NewsSitemap extends Sitemap
{
    /**
     * @param NewsItem $item
     *
     * @throws \InvalidArgumentException
     */
    protected function validateItemClassType($item)
    {
        if (!($item instanceof NewsItem)) {
            throw new \InvalidArgumentException(
                "Provided \$item is not instance of \\League\\Sitemap\\Item\\News\\NewsItem."
            );
        }
    }


    /**
     * @return string
     */
    protected function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" ' .
        'xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">' . "\n";
    }

    /**
     * @return string
     */
    protected function getFooter()
    {
        return "</urlset>";
    }
}
