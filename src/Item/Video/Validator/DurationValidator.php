<?php
namespace League\Sitemap\Item\Video\Validator;

final class DurationValidator
{
    /**
     * The duration of the video in seconds. Value must be between 0 and 28800 (8 hours).
     *
     * @param $seconds
     *
     * @return bool|string
     */
    public static function validate($seconds)
    {
        if ($seconds <= 28800 && $seconds >= 0) {
            return $seconds;
        }

        return false;
    }
}
