<?php
namespace League\Sitemap\Item\Index;

use League\Sitemap\Item\Url\UrlItem;
use League\Sitemap\Item\Url\UrlItemValidator;

class IndexItem extends UrlItem
{
    /**
     * @var UrlItemValidator
     */
    protected $validator;

    /**
     * @var string
     */
    protected $exceptionMessage = 'Operation not supported for Index Sitemaps';

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return [
            '<sitemap>',
            'loc'     => '',
            'lastmod' => '',
            '</sitemap>',
        ];
    }

    /**
     * @param $priority
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setPriority($priority)
    {
        throw new \InvalidArgumentException($this->exceptionMessage);
    }

    /**
     * @param $changeFreq
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setChangeFreq($changeFreq)
    {
        throw new \InvalidArgumentException($this->exceptionMessage);
    }
}
