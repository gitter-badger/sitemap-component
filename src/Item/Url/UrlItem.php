<?php
namespace League\Sitemap\Item\Url;

use League\Sitemap\Item\AbstractItem;

class UrlItem extends AbstractItem
{
    /**
     * @var UrlItemValidator
     */
    private $validator;

    /**
     * @param $loc
     */
    public function __construct($loc)
    {
        $this->validator = new UrlItemValidator();
        $this->xml       = $this->reset();
        $this->setLoc($loc);
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return [
            "<url>",
            'loc'        => '',
            'lastmod'    => '',
            'changefreq' => '',
            'priority'   => '',
            "</url>"
        ];
    }

    /**
     * @param $loc
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function setLoc($loc)
    {
        $this->writeFullTag(
            $loc,
            'loc',
            false,
            'loc',
            $this->validator,
            'validateUrl',
            'Provided URL is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $lastmod
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setLastMod($lastmod)
    {
        $this->writeFullTag(
            $lastmod,
            'lastmod',
            false,
            'lastmod',
            $this->validator,
            'validateLastmod',
            'Provided modification date is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $changeFreq
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setChangeFreq($changeFreq)
    {
        $this->writeFullTag(
            $changeFreq,
            'changefreq',
            false,
            'changefreq',
            $this->validator,
            'validateChangeFreq',
            'Provided change frequency is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $priority
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->writeFullTag(
            $priority,
            'priority',
            false,
            'priority',
            $this->validator,
            'validatePriority',
            'Provided priority is not a valid value.'
        );

        return $this;
    }
}
