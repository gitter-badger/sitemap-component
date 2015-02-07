<?php
namespace League\Sitemap\Item\Video\Validator;

final class RatingValidator
{
    /**
     * The rating of the video. Allowed values are float numbers in the range 0.0 to 5.0.
     *
     * @param $rating
     *
     * @return string|false
     */
    public static function validate($rating)
    {
        if (is_numeric($rating) && $rating > -0.01 && $rating < 5.01) {
            preg_match('/([0-9].[0-9])/', $rating, $matches);
            $matches[0] = floatval($matches[0]);

            return (!empty($matches[0]) && $matches[0] <= 5.0 && $matches[0] >= 0.0) ? $matches[0] : false;
        }

        return false;
    }
}
