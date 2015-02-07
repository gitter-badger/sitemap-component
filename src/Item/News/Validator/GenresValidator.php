<?php

namespace League\Sitemap\Item\News\Validator;

final class GenresValidator
{
    /**
     * https://support.google.com/news/publisher/answer/93992
     *
     * @var array
     */
    protected static $genres = array(
        'PressRelease',
        'Satire',
        'Blog',
        'OpEd',
        'Opinion',
        'UserGenerated',
    );

    /**
     * @param $genres
     *
     * @return string|false
     */
    public static function validate($genres)
    {
        $data = array();
        if (is_string($genres)) {
            $genres = str_replace(",", " ", $genres);
            $genres = explode(" ", $genres);
            $genres = array_filter($genres);
        }

        if (is_array($genres)) {
            foreach ($genres as $genre) {
                if (in_array($genre, self::$genres, true)) {
                    $data[] = $genre;
                }
            }
        }

        $data = implode(", ", $data);

        return (strlen($data) > 0) ? $data : false;
    }
}
