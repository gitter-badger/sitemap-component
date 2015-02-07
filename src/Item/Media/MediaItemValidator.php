<?php
namespace League\Sitemap\Item\Media;

use League\Sitemap\Item\ValidatorTrait;

class MediaItemValidator
{
    use ValidatorTrait;

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
     * @param $mimeType
     *
     * @return string|false
     */
    public function validateMimeType($mimeType)
    {
        return $this->validateString($mimeType);
    }

    /**
     * @param $link
     *
     * @return string|false
     */
    public function validateLink($link)
    {
        return $this->validateLoc($link);
    }

    /**
     * @param $player
     *
     * @return string|false
     */
    public function validatePlayer($player)
    {
        return $this->validateLoc($player);
    }

    /**
     * @param $duration
     *
     * @return bool|integer
     */
    public function validateDuration($duration)
    {
        return $this->validateInteger($duration);
    }

    /**
     * @param $description
     *
     * @return string|false
     */
    public function validateDescription($description)
    {
        return $this->validateString($description);
    }

    /**
     * @param $thumbnail
     *
     * @return string|false
     */
    public function validateThumbnail($thumbnail)
    {
        return $this->validateLoc($thumbnail);
    }

    /**
     * @param $height
     *
     * @return bool|integer
     */
    public function validateHeight($height)
    {
        return $this->validateInteger($height);
    }

    /**
     * @param $width
     *
     * @return bool|integer
     */
    public function validateWidth($width)
    {
        return $this->validateInteger($width);
    }
}
