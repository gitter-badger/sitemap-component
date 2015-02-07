<?php
namespace League\Sitemap\Item\Video;

use League\Sitemap\Item\AbstractItem;

abstract class VideoItemPriceTags extends AbstractItem
{
    /**
     * @param VideoItemValidator $validator
     * @param                    $price
     * @param                    $currency
     * @param string|null        $type
     * @param string|null        $resolution
     *
     * @return string
     */
    public static function setPrice($validator, $price, $currency, $type = null, $resolution = null)
    {
        self::$xml['price'] .= '<video:price';
        self::setPriceValue($validator, $price);
        self::setPriceCurrency($validator, $currency);
        self::setPriceType($validator, $type);
        self::setPriceResolution($validator, $resolution);
        self::$xml['price'] .= '>'.$price.'</video:price>';

        return self::$xml['price'];
    }

    /**
     * @param VideoItemValidator $validator
     * @param $price
     */
    protected static function setPriceValue($validator, $price)
    {
        self::validateInput(
            $price,
            $validator,
            'validatePrice',
            'Provided price is not a valid value.'
        );
    }

    /**
     * @param VideoItemValidator $validator
     * @param $currency
     *
     */
    protected static function setPriceCurrency($validator, $currency)
    {
        self::writeAttribute(
            $currency,
            'price',
            'currency',
            $validator,
            'validatePriceCurrency',
            'Provided price currency is not a valid value.'
        );
    }

    /**
     * @param             VideoItemValidator $validator
     * @param string|null $type
     *
     */
    protected static function setPriceType($validator, $type)
    {
        if (null !== $type) {
            self::writeAttribute(
                $type,
                'price',
                'type',
                $validator,
                'validatePriceType',
                'Provided price type is not a valid value.'
            );
        }
    }

    /**
     * @param             VideoItemValidator $validator
     * @param string|null $resolution
     *
     */
    protected static function setPriceResolution($validator, $resolution)
    {
        if (null !== $resolution) {
            self::writeAttribute(
                $resolution,
                'price',
                'resolution',
                $validator,
                'validatePriceResolution',
                'Provided price resolution is not a valid value.'
            );
        }
    }
}
