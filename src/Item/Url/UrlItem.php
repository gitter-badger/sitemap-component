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
        $this->validator = UrlItemValidator::getInstance();
        self::$xml       = $this->reset();
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
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    protected function setLoc($loc)
    {
        self::writeFullTag(
            $loc,
            'loc',
            false,
            'loc',
            $this->validator,
            'validateLoc',
            'Provided URL is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $lastmod
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setLastMod($lastmod)
    {
        self::writeFullTag(
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
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setChangeFreq($changeFreq)
    {
        self::writeFullTag(
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
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setPriority($priority)
    {
        self::writeFullTag(
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
