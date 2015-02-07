<?php

namespace League\Sitemap\Item\Video\Validator;

final class PlatformValidator
{
    /**
     * @param $platform
     *
     * @return string|false
     */
    public static function validate($platform)
    {
        $platforms = explode(" ", $platform);
        array_filter($platforms);

        foreach ($platforms as $key => $platform) {
            if (strtolower($platform) != 'tv' && strtolower($platform) != 'mobile' && strtolower($platform) != 'web') {
                unset($platforms[$key]);
            }
        }

        $data = implode(' ', $platforms);

        return (strlen($data) > 0) ? $data : false;
    }
}
