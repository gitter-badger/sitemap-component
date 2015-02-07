<?php
namespace League\Sitemap\Item\Video\Validator;

final class PriceTypeValidator
{
    /**
     * @param string $type
     *
     * @return string|false
     */
    public static function validate($type)
    {
        $lowercaseType = strtolower($type);
        if ('own' === $lowercaseType || 'rent' === $lowercaseType) {
            return $lowercaseType;
        }

        return false;
    }
}
