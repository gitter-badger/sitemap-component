<?php
namespace League\Sitemap;

interface SitemapInterface
{
    /**
     * Adds a new sitemap item.
     *
     * @param        $item
     * @param string $url
     *
     * @return mixed
     */
    public function add($item, $url = '');

    /**
     * Generates sitemap file.
     *
     * @return mixed
     */
    public function build();
}
