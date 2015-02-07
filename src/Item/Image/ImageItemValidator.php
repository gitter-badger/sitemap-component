<?php
namespace League\Sitemap\Item\Image;

use League\Sitemap\Item\ValidatorTrait;

class ImageItemValidator
{
    use ValidatorTrait;

    /**
     * @param $url
     *
     * @return false|string
     */
    public function validateUrl($url)
    {
        return $this->validateLoc($url);
    }

    /**
     * @param $title
     *
     * @return string|false
     */
    public function validateTitle($title)
    {
        return $this->validateString($title);
    }

    /**
     * @param $caption
     *
     * @return string|false
     */
    public function validateCaption($caption)
    {
        return $this->validateString($caption);
    }

    /**
     * @param $geoLocation
     *
     * @return string|false
     */
    public function validateGeoLocation($geoLocation)
    {
        return $this->validateString($geoLocation);
    }

    /**
     * @param $license
     *
     * @return string|false
     */
    public function validateLicense($license)
    {
        return $this->validateString($license);
    }
}
