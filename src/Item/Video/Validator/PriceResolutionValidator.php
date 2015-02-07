<?php
namespace League\Sitemap\Item\Video\Validator;

final class PriceResolutionValidator
{
    /**
     * @param string $resolution
     *
     * @return string|false
     */
    public static function validate($resolution)
    {
        $uppercaseResolution = strtoupper($resolution);
        if ('HD' === $uppercaseResolution || 'SD' === $uppercaseResolution) {
            return $uppercaseResolution;
        }

        return false;
    }
}
