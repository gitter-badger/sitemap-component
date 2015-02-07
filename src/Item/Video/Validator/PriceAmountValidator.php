<?php
namespace League\Sitemap\Item\Video\Validator;

final class PriceAmountValidator
{
    /**
     * @param $price
     *
     * @return bool
     */
    public static function validate($price)
    {
        if (
            (filter_var($price, FILTER_VALIDATE_FLOAT) || filter_var($price, FILTER_VALIDATE_INT))
            && $price >= 0
        ) {
            return $price;
        }

        return false;
    }
}
