<?php

namespace League\Sitemap;

use League\Sitemap\Item\Media\MediaItem;
use League\Sitemap\Item\ValidatorTrait;

class MediaSitemap extends Sitemap
{
    use ValidatorTrait;

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $link = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @param $title
     *
     * @throws SitemapException
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $this->setStringValue('title', $title);

        return $this;
    }

    /**
     * @param string $tag
     * @param string $string
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function setStringValue($tag, $string)
    {
        if (false === $this->validateString($string)) {
            throw new \InvalidArgumentException(sprintf('Value for %s is not valid', $tag));
        }

        return "<$tag>{$string}</$tag>";
    }

    /**
     * @param string $link
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setLink($link)
    {
        if (false === $this->validateLoc($link)) {
            throw new \InvalidArgumentException('Value for setLink is not a valid URL');
        }

        $this->link = "<link>{$link}</link>";

        return $this;
    }

    /**
     * @param string $description
     *
     * @throws SitemapException
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $this->setStringValue('description', $description);

        return $this;
    }

    /**
     * @param MediaItem $item
     *
     * @throws \InvalidArgumentException
     */
    protected function validateItemClassType($item)
    {
        if (!($item instanceof MediaItem)) {
            throw new \InvalidArgumentException(
                "Provided \$item is not instance of \\League\\Sitemap\\Item\\Media\\MediaItem."
            );
        }
    }

    /**
     * @return string
     */
    protected function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
        '<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">'
        . "\n" . '<channel>' . "\n" . $this->title . $this->link . $this->description;
    }

    /**
     * @return string
     */
    protected function getFooter()
    {
        return "</channel>\n</rss>";
    }
}
