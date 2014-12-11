<?php

namespace NilPortugues\Sitemap\Item;

/**
 * Trait ValidatorTrait
 * @package NilPortugues\Sitemap\Item
 */
trait ValidatorTrait
{
    /**
     * The location URI of a document. The URI must conform to RFC 2396 (http://www.ietf.org/rfc/rfc2396.txt)
     *
     * @param $value
     * @return bool|string
     */
    public function validateLoc($value)
    {
        if (filter_var($value, FILTER_VALIDATE_URL, array('options' => array('flags' => FILTER_FLAG_PATH_REQUIRED)))) {
            return htmlentities($value);
        }

        return false;
    }

    /**
     * The date must conform to the W3C DATETIME format (http://www.w3.org/TR/NOTE-datetime).
     * Example: 2005-05-10 Lastmod may also contain a timestamp or 2005-05-10T17:33:30+08:00
     *
     * @param string $value
     *
     * @return bool|string
     */
    protected function validateDate($value)
    {
        if (false !== ($date = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $value))) {
            return htmlentities($date->format('c'));
        }
        if (false !== ($date = \DateTime::createFromFormat('Y-m-d', $value))) {
            return htmlentities($date->format('Y-m-d'));
        }

        return false;
    }
}