<?php
namespace League\Sitemap\Item\Image;

use League\Sitemap\Item\AbstractItem;

class ImageItem extends AbstractItem
{
    /**
     * @var ImageItemValidator
     */
    protected $validator;

    /**
     * @param $loc
     */
    public function __construct($loc)
    {
        $this->validator = ImageItemValidator::getInstance();
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
            "<image:image>",
            'loc'         => '',
            'title'       => '',
            'caption'     => '',
            'geolocation' => '',
            'license'     => '',
            "</image:image>"
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
            'image:loc',
            $this->validator,
            'validateLoc',
            'Provided URL is not a valid value.'
        );

        return $this;
    }


    /**
     * @param $title
     *
     * @return $this
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     */
    public function setTitle($title)
    {
        self::writeFullTag(
            $title,
            'title',
            true,
            'image:title',
            $this->validator,
            'validateTitle',
            'Provided title is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $caption
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setCaption($caption)
    {
        self::writeFullTag(
            $caption,
            'caption',
            true,
            'image:caption',
            $this->validator,
            'validateCaption',
            'Provided caption is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $geoLocation
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setGeoLocation($geoLocation)
    {
        self::writeFullTag(
            $geoLocation,
            'geolocation',
            true,
            'image:geolocation',
            $this->validator,
            'validateGeoLocation',
            'Provided geolocation is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $license
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setLicense($license)
    {
        self::writeFullTag(
            $license,
            'license',
            true,
            'image:license',
            $this->validator,
            'validateLicense',
            'Provided license is not a valid value.'
        );

        return $this;
    }
}
