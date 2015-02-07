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
        $this->validator = new ImageItemValidator();
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
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function setLoc($loc)
    {
        $this->writeFullTag(
            $loc,
            'loc',
            false,
            'image:loc',
            $this->validator,
            'validateUrl',
            'Provided URL is not a valid value.'
        );

        return $this;
    }


    /**
     * @param $title
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setTitle($title)
    {
        $this->writeFullTag(
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
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setCaption($caption)
    {
        $this->writeFullTag(
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
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setGeoLocation($geoLocation)
    {
        $this->writeFullTag(
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
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setLicense($license)
    {
        $this->writeFullTag(
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
