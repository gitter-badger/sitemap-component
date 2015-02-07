<?php
namespace League\Sitemap\Item\Video;

use League\Sitemap\Item\AbstractItem;

abstract class VideoItemUploaderTags extends AbstractItem
{
    /**
     * @var string
     */
    protected static $exception = 'League\Sitemap\Item\Video\VideoItemException';

    /**
     * @param VideoItemValidator $validator
     * @param                    $uploader
     * @param null               $info
     *
     * @return string
     */
    public static function setUploader($validator, $uploader, $info = null)
    {
        self::validateInput(
            $uploader,
            $validator,
            'validateUploader',
            self::$exception,
            'Provided uploader is not a valid value.'
        );

        self::$xml['uploader'] = '<video:uploader';
        self::setUploaderInfo($validator, $info);
        self::$xml['uploader'] .= '>'.$uploader.'</video:uploader>';

        return self::$xml['uploader'];
    }

    /**
     * @param VideoItemValidator $validator
     * @param $info
     */
    protected static function setUploaderInfo($validator, $info)
    {
        if (null !== $info) {
            self::writeAttribute(
                $info,
                'uploader',
                'info',
                $validator,
                'validateUploaderInfo',
                self::$exception,
                'Provided uploader info is not a valid value.'
            );
        }
    }
}
