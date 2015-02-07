<?php
namespace League\Sitemap\Item\Video;

use League\Sitemap\Item\AbstractItem;

class VideoItemPlayerTags extends AbstractItem
{
    /**
     * @var array
     */
    protected $xml = [
        'player_loc' => '',
    ];

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return ['player_loc' => ''];
    }


    /**
     * @param VideoItemValidator $validator
     * @param                    $loc
     * @param                    $playerEmbedded
     * @param                    $playerAutoPlay
     */
    public function __construct($validator, $loc, $playerEmbedded, $playerAutoPlay)
    {
        $this->validateInput(
            $loc,
            $validator,
            'validatePlayerLoc',
            'Provided player URL is not a valid value.'
        );

        $this->xml['player_loc'] = '<video:player_loc';
        $this->setPlayerEmbedded($validator, $playerEmbedded);
        $this->setPlayerAutoPlay($validator, $playerAutoPlay);

        $this->xml['player_loc'] .= '>'.$loc.'</video:player_loc>';
    }

    /**
     * @param VideoItemValidator $validator
     * @param $playerEmbedded
     *
     */
    protected function setPlayerEmbedded($validator, $playerEmbedded)
    {
        if (null !== $playerEmbedded) {
            $this->writeAttribute(
                $playerEmbedded,
                'player_loc',
                'allow_embed',
                $validator,
                'validateAllowEmbed',
                'Provided player allow embed is not a valid value.'
            );
        }
    }

    /**
     * @param VideoItemValidator $validator
     * @param $playerAutoplay
     */
    protected function setPlayerAutoPlay($validator, $playerAutoplay)
    {
        if (null !== $playerAutoplay) {
            $this->writeAttribute(
                $playerAutoplay,
                'player_loc',
                'autoplay',
                $validator,
                'validateAutoPlay',
                'Provided player autoplay is not a valid value.'
            );
        }
    }
}
