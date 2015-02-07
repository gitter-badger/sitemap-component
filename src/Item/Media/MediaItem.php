<?php

namespace League\Sitemap\Item\Media;

use League\Sitemap\Item\AbstractItem;

class MediaItem extends AbstractItem
{
    /**
     * @var MediaItemValidator
     */
    protected $validator;

    /**
     *
     */
    public function __construct($link)
    {
        $this->validator = new MediaItemValidator();
        $this->xml       = $this->reset();
        $this->setLink($link);
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return [
            '<item xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">',
            'content'        => '',
            'link'        => '',
            'duration'    => '',
            'player'      => '',
            'title'       => '',
            'description' => '',
            'thumbnail'   => '',
            '</media:content>',
            '</item>',
        ];
    }

    /**
     * @param $link
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function setLink($link)
    {
        $this->writeFullTag(
            $link,
            'link',
            false,
            'link',
            $this->validator,
            'validateLink',
            'Provided link is not a valid value.'
        );

        return $this;
    }


    /**
     * @param      $mimeType
     * @param null $duration
     *
     * @return MediaItem
     */
    public function setContent($mimeType, $duration = null)
    {
        $this->xml['content'] = "<media:content";
        $this->setContentMimeType($mimeType);
        $this->setContentDuration($duration);
        $this->xml['content'] .= ">";

        return $this;
    }

    /**
     * @param $mimeType
     *
     * @throws \InvalidArgumentException
     */
    protected function setContentMimeType($mimeType)
    {
        $this->writeAttribute(
            $mimeType,
            'content',
            'type',
            $this->validator,
            'validateMimeType',
            'Provided mime-type is not a valid value.'
        );
    }

    /**
     * @param $duration
     *
     * @throws \InvalidArgumentException
     */
    protected function setContentDuration($duration)
    {
        if (null !== $duration) {
            $this->writeAttribute(
                $duration,
                'content',
                'duration',
                $this->validator,
                'validateDuration',
                'Provided duration is not a valid value.'
            );
        }
    }

    /**
     * @param $player
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setPlayer($player)
    {
        $this->xml['player'] = "<media:player";

        $this->writeAttribute(
            $player,
            'player',
            'url',
            $this->validator,
            'validatePlayer',
            'Provided player URL is not a valid value.'
        );

        $this->xml['player'] .= " />";

        return $this;
    }

    /**
     * @param $title
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setTitle($title)
    {
        $this->writeFullTag(
            $title,
            'title',
            false,
            'media:title',
            $this->validator,
            'validateTitle',
            'Provided title is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $description
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setDescription($description)
    {
        $this->writeFullTag(
            $description,
            'description',
            false,
            'media:description',
            $this->validator,
            'validateDescription',
            'Provided description is not a valid value.'
        );

        return $this;
    }

    /**
     * @param      $thumbnail
     * @param null $height
     * @param null $weight
     *
     * @return $this
     */
    public function setThumbnail($thumbnail, $height = null, $weight = null)
    {
        $this->xml['thumbnail'] = "<media:thumbnail";
        $this->setThumbnailUrl($thumbnail);

        if (null !== $height) {
            $this->setThumbnailHeight($height);
        }

        if (null !== $weight) {
            $this->setThumbnailWidth($weight);
        }

        $this->xml['thumbnail'] .= "/>";

        return $this;
    }

    /**
     * @param $url
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function setThumbnailUrl($url)
    {
        $this->writeAttribute(
            $url,
            'thumbnail',
            'url',
            $this->validator,
            'validateThumbnail',
            'Provided thumbnail URL is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $height
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function setThumbnailHeight($height)
    {
        $this->writeAttribute(
            $height,
            'thumbnail',
            'height',
            $this->validator,
            'validateHeight',
            'Provided height is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $width
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function setThumbnailWidth($width)
    {
        $this->writeAttribute(
            $width,
            'thumbnail',
            'width',
            $this->validator,
            'validateWidth',
            'Provided width is not a valid value.'
        );

        return $this;
    }
}
