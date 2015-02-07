<?php
namespace League\Sitemap\Item\News;

use League\Sitemap\Item\News\Validator\AccessValidator;
use League\Sitemap\Item\News\Validator\GenresValidator;
use League\Sitemap\Item\News\Validator\LanguageValidator;
use League\Sitemap\Item\ValidatorTrait;

class NewsItemValidator
{
    use ValidatorTrait;

    /**
     * @param $name
     *
     * @return string|false
     */
    public function validateName($name)
    {
        return self::validateString($name);
    }

    /**
     * @param $language
     *
     * @return string|false
     */
    public function validateLanguage($language)
    {
        return LanguageValidator::validate($language);
    }

    /**
     * @param $access
     *
     * @return string|false
     */
    public function validateAccess($access)
    {
        return AccessValidator::validate($access);
    }

    /**
     * @param $genres
     *
     * @return string|false
     */
    public function validateGenres($genres)
    {
        return GenresValidator::validate($genres);
    }

    /**
     * @param $publicationDate
     *
     * @return string|false
     */
    public function validatePublicationDate($publicationDate)
    {
        return self::validateDate($publicationDate);
    }

    /**
     * @param $title
     *
     * @return string|false
     */
    public function validateTitle($title)
    {
        return self::validateString($title);
    }

    /**
     * @param $keywords
     *
     * @return string|false
     */
    public function validateKeywords($keywords)
    {
        return self::validateString($keywords);
    }

    /**
     * @param $stock
     *
     * @return string|false
     */
    public function validateStockTickers($stock)
    {
        return self::validateString($stock);
    }
}
