<?php
namespace League\Sitemap\Item\News\Validator;

final class AccessValidator
{
    /**
     * @param $access
     *
     * @return string|false
     */
    public static function validate($access)
    {
        $lowercaseAccess = strtolower($access);

        if ('subscription' === $lowercaseAccess || 'registration' === $lowercaseAccess) {
            return ucfirst($lowercaseAccess);
        }

        return false;
    }
}
