<?php
namespace League\Sitemap\Item\Video;

use League\Sitemap\Item\AbstractItem;

class VideoItemUploaderTags extends AbstractItem
{
    /**
     * @var array
     */
    protected $xml = [
        'uploader' => ''
    ];

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return ['uploader' => ''];
    }

    /**
     * @param VideoItemValidator $validator
     * @param                    $uploader
     * @param null               $info
     */
    public function __construct($validator, $uploader, $info = null)
    {
        $this->validateInput(
            $uploader,
            $validator,
            'validateUploader',
            'Provided uploader is not a valid value.'
        );

        $this->xml['uploader'] = '<video:uploader';
        $this->setUploaderInfo($validator, $info);
        $this->xml['uploader'] .= '>'.$uploader.'</video:uploader>';
    }

    /**
     * @param VideoItemValidator $validator
     * @param $info
     */
    protected function setUploaderInfo($validator, $info)
    {
        if (null !== $info) {
            $this->writeAttribute(
                $info,
                'uploader',
                'info',
                $validator,
                'validateUploaderInfo',
                'Provided uploader info is not a valid value.'
            );
        }
    }
}
