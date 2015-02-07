<?php
namespace League\Sitemap\Item\Video\Validator;

final class DescriptionValidator
{
    /**
     * The description of the video. Maximum 2048 characters.
     * The description must be in plain text only, and any HTML entities should be escaped or wrapped in a CDATA block.
     *
     * @param $description
     *
     * @return string|false
     */
    public static function validate($description)
    {
        $length = mb_strlen($description, 'UTF-8');
        if ($length > 0 && $length < 2048) {
            return $description;
        }

        return false;
    }
}
