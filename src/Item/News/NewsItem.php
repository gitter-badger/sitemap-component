<?php
namespace League\Sitemap\Item\News;

use League\Sitemap\Item\AbstractItem;

class NewsItem extends AbstractItem
{
    /**
     * @var NewsItemValidator
     */
    protected $validator;

    /**
     * @param $loc
     * @param $title
     * @param $publicationDate
     * @param $name
     * @param $language
     */
    public function __construct($loc, $title, $publicationDate, $name, $language)
    {
        $this->validator = new NewsItemValidator();
        $this->xml       = $this->reset();
        $this->setLoc($loc);
        $this->setTitle($title);
        $this->setPublicationDate($publicationDate);
        $this->setPublication($name, $language);
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return [
            '<url>',
            'loc'              => '',
            '<news:news>',
            'name'             => '',
            'access'           => '',
            'genres'           => '',
            'publication_date' => '',
            'title'            => '',
            'keywords'         => '',
            'stock_tickers'    => '',
            '</news:news>',
            '</url>',
        ];
    }

    /**
     * @param $loc
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function setLoc($loc)
    {
        $this->writeFullTag(
            $loc,
            'loc',
            false,
            'loc',
            $this->validator,
            'validateUrl',
            'Provided URL is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $title
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function setTitle($title)
    {
        $this->writeFullTag(
            $title,
            'title',
            false,
            'news:title',
            $this->validator,
            'validateTitle',
            'Provided title is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $date
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function setPublicationDate($date)
    {
        $this->writeFullTag(
            $date,
            'publication_date',
            false,
            'news:publication_date',
            $this->validator,
            'validatePublicationDate',
            'Provided publication date is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $name
     * @param $language
     *
     * @return $this
     */
    protected function setPublication($name, $language)
    {
        $this->xml['name'] = '<news:publication>';
        $this->setPublicationName($name);
        $this->setPublicationLanguage($language);
        $this->xml['name'] .= '</news:publication>';

        return $this;
    }

    /**
     * @param $name
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function setPublicationName($name)
    {
        $this->writeFullTag(
            $name,
            'name',
            false,
            'news:name',
            $this->validator,
            'validateName',
            'Provided publication name is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $language
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function setPublicationLanguage($language)
    {
        $this->writeFullTag(
            $language,
            'name',
            false,
            'news:language',
            $this->validator,
            'validateLanguage',
            'Provided publication language is not a valid value.'
        );

        return $this;
    }


    /**
     * @param $access
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setAccess($access)
    {
        $this->writeFullTag(
            $access,
            'access',
            false,
            'news:access',
            $this->validator,
            'validateAccess',
            'Provided access date is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $genres
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setGenres($genres)
    {
        $this->writeFullTag(
            $genres,
            'genres',
            false,
            'news:genres',
            $this->validator,
            'validateGenres',
            'Provided genres list is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $keywords
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setKeywords($keywords)
    {
        $this->writeFullTag(
            $keywords,
            'keywords',
            false,
            'news:keywords',
            $this->validator,
            'validateKeywords',
            'Provided keyword list is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $stockTickers
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setStockTickers($stockTickers)
    {
        $this->writeFullTag(
            $stockTickers,
            'stock_tickers',
            false,
            'news:stock_tickers',
            $this->validator,
            'validateStockTickers',
            'Provided stock tickers is not a valid value.'
        );

        return $this;
    }
}
