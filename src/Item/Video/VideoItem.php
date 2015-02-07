<?php
namespace League\Sitemap\Item\Video;

use League\Sitemap\Item\AbstractItem;

class VideoItem extends AbstractItem
{
    /**
     * @var VideoItemValidator
     */
    protected $validator;

    /**
     * @var string
     */
    protected $exception = 'League\Sitemap\Item\Video\VideoItemException';

    /**
     * @param $title
     * @param $contentLoc
     * @param $playerLoc
     * @param $playerEmbedded
     * @param $playerAutoplay
     */
    public function __construct($title, $contentLoc, $playerLoc, $playerEmbedded = null, $playerAutoplay = null)
    {
        $this->validator = VideoItemValidator::getInstance();
        self::$xml       = $this->reset();
        $this->setTitle($title);
        $this->setContentLoc($contentLoc);
        $this->setPlayerLoc($playerLoc, $playerEmbedded, $playerAutoplay);
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return [
            '<video:video>',
            'thumbnail_loc'         => '',
            'title'                 => '',
            'description'           => '',
            'content_loc'           => '',
            'player_loc'            => '',
            'duration'              => '',
            'expiration_date'       => '',
            'rating'                => '',
            'view_count'            => '',
            'publication_date'      => '',
            'family_friendly'       => '',
            'restriction'           => '',
            'gallery_loc'           => '',
            'price'                 => '',
            'category'              => '',
            'tag'                   => '',
            'requires_subscription' => '',
            'uploader'              => '',
            'platform'              => '',
            'live'                  => '',
            '</video:video>',
        ];
    }

    /**
     * @param $title
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    protected function setTitle($title)
    {
        self::writeFullTag(
            $title,
            'title',
            true,
            'video:title',
            $this->validator,
            'validateTitle',
            'Provided title value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $loc
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    protected function setContentLoc($loc)
    {
        self::writeFullTag(
            $loc,
            'content_loc',
            true,
            'video:content_loc',
            $this->validator,
            'validateContentLoc',
            'Provided content URL is not a valid.'
        );

        return $this;
    }

    /**
     * @param $loc
     *
     * @param $playerEmbedded
     * @param $playerAutoPlay
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    protected function setPlayerLoc($loc, $playerEmbedded, $playerAutoPlay)
    {
        self::$xml['player_loc'] = VideoItemPlayerTags::setPlayerLoc(
            $this->validator,
            $loc,
            $playerEmbedded,
            $playerAutoPlay
        );

        return $this;
    }


    /**
     * @param $loc
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setThumbnailLoc($loc)
    {
        self::writeFullTag(
            $loc,
            'thumbnail_loc',
            true,
            'video:thumbnail_loc',
            $this->validator,
            'validateThumbnailLoc',
            'Provided thumbnail URL is not a valid.'
        );

        return $this;
    }

    /**
     * @param $description
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setDescription($description)
    {
        self::writeFullTag(
            $description,
            'description',
            true,
            'video:description',
            $this->validator,
            'validateDescription',
            'Provided description value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $duration
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setDuration($duration)
    {
        self::writeFullTag(
            $duration,
            'duration',
            true,
            'video:duration',
            $this->validator,
            'validateDuration',
            'Provided duration value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $expirationDate
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setExpirationDate($expirationDate)
    {
        self::writeFullTag(
            $expirationDate,
            'expiration_date',
            true,
            'video:expiration_date',
            $this->validator,
            'validateExpirationDate',
            'Provided expiration date value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $rating
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setRating($rating)
    {
        self::writeFullTag(
            $rating,
            'rating',
            true,
            'video:rating',
            $this->validator,
            'validateRating',
            'Provided rating value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $viewCount
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setViewCount($viewCount)
    {
        self::writeFullTag(
            $viewCount,
            'view_count',
            true,
            'video:view_count',
            $this->validator,
            'validateViewCount',
            'Provided view count value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $publicationDate
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setPublicationDate($publicationDate)
    {
        self::writeFullTag(
            $publicationDate,
            'publication_date',
            true,
            'video:publication_date',
            $this->validator,
            'validatePublicationDate',
            'Provided publication date value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $familyFriendly
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setFamilyFriendly($familyFriendly)
    {
        self::writeFullTag(
            $familyFriendly,
            'family_friendly',
            true,
            'video:family_friendly',
            $this->validator,
            'validateFamilyFriendly',
            'Provided family friendly value is not a valid.'
        );

        return $this;
    }

    /**
     * @param      $restriction
     * @param null $relationship
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setRestriction($restriction, $relationship = null)
    {
        $this->validateInput(
            $restriction,
            $this->validator,
            'validateRestriction',
            'Provided restriction is not a valid value.'
        );

        self::$xml['restriction'] = '<video:restriction';
        $this->setRestrictionRelationship($relationship);
        self::$xml['restriction'] .= '>'.$restriction.'</video:restriction>';

        return $this;
    }

    /**
     * @param $relationship
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    protected function setRestrictionRelationship($relationship)
    {
        if (null !== $relationship) {
            $this->writeAttribute(
                $relationship,
                'restriction',
                'relationship',
                $this->validator,
                'validateRestrictionRelationship',
                    'Provided restriction relationship is not a valid value.'
            );
        }

        return $this;
    }

    /**
     * @param      $galleryLoc
     * @param null $title
     *
     * @return $this
     */
    public function setGalleryLoc($galleryLoc, $title = null)
    {
        self::$xml['gallery_loc'] = VideoItemGalleryTags::setGalleryLoc($this->validator, $galleryLoc, $title);

        return $this;
    }

    /**
     * @param        $price
     * @param        $currency
     * @param string $type
     * @param string $resolution
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return VideoItem
     */
    public function setPrice($price, $currency, $type = null, $resolution = null)
    {
        self::$xml['price'] .= VideoItemPriceTags::setPrice($this->validator, $price, $currency, $type, $resolution);

        return $this;
    }

    /**
     * @param $category
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setCategory($category)
    {
        self::writeFullTag(
            $category,
            'category',
            true,
            'video:category',
            $this->validator,
            'validateCategory',
            'Provided category value is not a valid.'
        );

        return $this;
    }

    /**
     * @param array $tag
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setTag(array $tag)
    {
        $this->validateInput(
            $tag,
            $this->validator,
            'validateTag',
            'Provided tag array is not a valid value.'
        );

        foreach ($tag as $tagName) {
            self::$xml['tag'] .= '<video:tag>'.$tagName.'</video:tag>';
        }

        return $this;
    }

    /**
     * @param $requires
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setRequiresSubscription($requires)
    {
        self::writeFullTag(
            $requires,
            'requires_subscription',
            true,
            'video:requires_subscription',
            $this->validator,
            'validateRequiresSubscription',
            'Provided requires subscription value is not a valid.'
        );

        return $this;
    }

    /**
     * @param      $uploader
     * @param null $info
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return string
     */
    public function setUploader($uploader, $info = null)
    {
        self::$xml['uploader'] = VideoItemUploaderTags::setUploader($this->validator, $uploader, $info);
    }

    /**
     * @param      $platform
     * @param null $relationship
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setPlatform($platform, $relationship = null)
    {
        $this->validateInput(
            $platform,
            $this->validator,
            'validatePlatform',
            'Provided platform is not a valid value.'
        );

        self::$xml['platform'] = '<video:platform';
        $this->setPlatformRelationship($relationship);
        self::$xml['platform'] .= '>'.$platform.'</video:platform>';

        return $this;
    }

    /**
     * @param $relationship
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    protected function setPlatformRelationship($relationship)
    {
        if (null !== $relationship) {
            $this->writeAttribute(
                $relationship,
                'platform',
                'relationship',
                $this->validator,
                'validatePlatformRelationship',
                    'Provided relationship is not a valid value.'
            );
        }

        return $this;
    }

    /**
     * @param $live
     *
     * @throws \League\Sitemap\Item\\InvalidArgumentException
     * @return $this
     */
    public function setLive($live)
    {
        self::writeFullTag(
            $live,
            'live',
            true,
            'video:live',
            $this->validator,
            'validateLive',
            'Provided live value is not a valid.'
        );

        return $this;
    }
}
