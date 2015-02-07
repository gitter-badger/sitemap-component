<?php
namespace League\Sitemap\Item\Video;

use League\Sitemap\Item\AbstractItem;

class VideoItemPriceTags extends AbstractItem
{
    /**
     * @var array
     */
    protected $xml = [
        'price' => ''
    ];

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return ['price' => ''];
    }

    /**
     * @param      $validator
     * @param      $price
     * @param      $currency
     * @param null $type
     * @param null $resolution
     */
    public function __construct($validator, $price, $currency, $type = null, $resolution = null)
    {
        $this->xml['price'] .= '<video:price';
        $this->setPriceValue($validator, $price);
        $this->setPriceCurrency($validator, $currency);
        $this->setPriceType($validator, $type);
        $this->setPriceResolution($validator, $resolution);
        $this->xml['price'] .= '>'.$price.'</video:price>';
    }

    /**
     * @param VideoItemValidator $validator
     * @param $price
     */
    protected function setPriceValue($validator, $price)
    {
        $this->validateInput(
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
    protected function setPriceCurrency($validator, $currency)
    {
        $this->writeAttribute(
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
    protected function setPriceType($validator, $type)
    {
        if (null !== $type) {
            $this->writeAttribute(
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
    protected function setPriceResolution($validator, $resolution)
    {
        if (null !== $resolution) {
            $this->writeAttribute(
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
