<?php
namespace League\Sitemap\Item\Url;

use League\Sitemap\Item\Url\Validator\ChangeFreqValidator;
use League\Sitemap\Item\Url\Validator\PriorityValidator;
use League\Sitemap\Item\ValidatorTrait;

class UrlItemValidator
{
    use ValidatorTrait;

    /**
     * @param $url
     *
     * @return false|string
     */
    public function validateUrl($url)
    {
        return $this->validateLoc($url);
    }

    /**
     * @param $lastmod
     *
     * @return string|false
     */
    public function validateLastMod($lastmod)
    {
        return $this->validateDate($lastmod);
    }

    /**
     * @param $changeFreq
     *
     * @return string|false
     */
    public function validateChangeFreq($changeFreq)
    {
        return ChangeFreqValidator::validate($changeFreq);
    }

    /**
     * The priority of a particular URL relative to other pages on the same site.
     * The value for this element is a number between 0.0 and 1.0 where 0.0 identifies the lowest priority page(s).
     * The default priority of a page is 0.5. Priority is used to select between pages on your site.
     * Setting a priority of 1.0 for all URLs will not help you, as the relative priority of pages on your site is what will be considered.
     *
     * @param $priority
     *
     * @return string|false
     */
    public function validatePriority($priority)
    {
        return PriorityValidator::validate($priority);
    }
}
