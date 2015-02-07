<?php
namespace League\Sitemap\Item\Image;

use League\Sitemap\Item\ValidatorTrait;

class ImageItemValidator
{
    use ValidatorTrait;

    /**
     * @param $title
     *
     * @return string|false
     */
    public function validateTitle($title)
    {
        return self::validateString($title);
    }

    /**
     * @param $caption
     *
     * @return string|false
     */
    public function validateCaption($caption)
    {
        return self::validateString($caption);
    }

    /**
     * @param $geoLocation
     *
     * @return string|false
     */
    public function validateGeoLocation($geoLocation)
    {
        return self::validateString($geoLocation);
    }

    /**
     * @param $license
     *
     * @return string|false
     */
    public function validateLicense($license)
    {
        return self::validateString($license);
    }
}
