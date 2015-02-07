<?php
namespace League\Sitemap\Item\Video;

use League\Sitemap\Item\AbstractItem;

class VideoItemGalleryTags extends AbstractItem
{
    /**
     * @var array
     */
    protected $xml = [
        'gallery_loc' => ''
    ];

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return ['gallery_loc' => ''];
    }


    /**
     * @param VideoItemValidator $validator
     * @param                    $galleryLoc
     * @param null               $title
     */
    public function __construct($validator, $galleryLoc, $title = null)
    {
        $this->validateInput(
            $galleryLoc,
            $validator,
            'validateGalleryLoc',
            'Provided gallery URL is not a valid value.'
        );

        $this->xml['gallery_loc'] = '<video:gallery_loc';
        $this->setGalleryTitle($validator, $title);
        $this->xml['gallery_loc'] .= '>'.$galleryLoc.'</video:gallery_loc>';
    }

    /**
     * @param VideoItemValidator $validator
     * @param $title
     */
    protected function setGalleryTitle($validator, $title)
    {
        if (null !== $title) {
            $this->writeAttribute(
                $title,
                'gallery_loc',
                'title',
                $validator,
                'validateGalleryLocTitle',
                'Provided gallery title is not a valid value.'
            );
        }
    }
}
