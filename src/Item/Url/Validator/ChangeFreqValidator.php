<?php

namespace League\Sitemap\Item\Url\Validator;

final class ChangeFreqValidator
{
    /**
     * @var array
     */
    protected static $changeFreqValid = array(
        "always",
        "hourly",
        "daily",
        "weekly",
        "monthly",
        "yearly",
        "never",
    );

    /**
     * @param $changeFreq
     *
     * @return string|false
     */
    public static function validate($changeFreq)
    {
        if (in_array(trim(strtolower($changeFreq)), self::$changeFreqValid, true)) {
            return htmlentities($changeFreq);
        }

        return false;
    }
}
