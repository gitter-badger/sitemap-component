<?php

namespace League\Sitemap\Tests\Item\Video;

use League\Sitemap\Item\Video\VideoItem;
use PHPUnit_Framework_TestCase;

class VideoItemTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var VideoItem
     */
    protected $item;

    /**
     * @var string
     */
    protected $exception = '\InvalidArgumentException';


    public function testItShouldThrowExceptionOnNewInstanceNoLoc()
    {
        $this->setExpectedException($this->exception);
        new VideoItem(
            '',
            'http://www.example.com/video123.flv',
            'http://www.example.com/videoplayer.swf?video=123'
        );
    }


    public function testItShouldThrowExceptionOnNewInstanceNoContentUrl()
    {
        $this->setExpectedException($this->exception);
        new VideoItem(
            'Grilling steaks for summer',
            '',
            'http://www.example.com/videoplayer.swf?video=123'
        );
    }


    public function testItShouldThrowExceptionOnNewInstanceNoPlayerLoc()
    {
        $this->setExpectedException($this->exception);
        new VideoItem(
            'Grilling steaks for summer',
            'http://www.example.com/video123.flv',
            ''
        );
    }


    public function testItShouldThrowExceptionOnNewInstanceNoValidPlayerEmbedded()
    {
        $this->setExpectedException($this->exception);
        $this->item = new VideoItem(
            'Grilling steaks for summer',
            'http://www.example.com/video123.flv',
            'http://www.example.com/videoplayer.swf?video=123',
            ''
        );
    }


    public function testItShouldThrowExceptionOnNewInstanceNoValidPlayerAutoPlay()
    {
        $this->setExpectedException($this->exception);
        $this->item = new VideoItem(
            'Grilling steaks for summer',
            'http://www.example.com/video123.flv',
            'http://www.example.com/videoplayer.swf?video=123',
            'yes',
            ''
        );
    }


    public function testItShouldHaveThumbnailLoc()
    {
        $this->item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
        $this->assertContains(
            '<video:thumbnail_loc><![CDATA[http://www.example.com/thumbs/123.jpg]]></video:thumbnail_loc>',
            $this->item->build()
        );
    }


    public function testItShouldHaveThumbnailLocAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setThumbnailLoc('');
    }


    public function testItShouldHaveDescription()
    {
        $this->item->setDescription('Alkis shows you how to get perfectly done steaks');
        $this->assertContains(
            '<video:description><![CDATA[Alkis shows you how to get perfectly done steaks]]></video:description>',
            $this->item->build()
        );

        $this->setExpectedException($this->exception);
        $this->item->setDescription('');
    }


    public function testItShouldHaveDescriptionAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setDescription('');
    }


    public function testItShouldHaveExpirationDate()
    {
        $this->item->setExpirationDate('2009-11-05T19:20:30+08:00');

        $this->assertContains(
            '<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>',
            $this->item->build()
        );
    }


    public function testItShouldHaveExpirationDateAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setExpirationDate('');
    }


    public function testItShouldHaveDuration()
    {
        $this->item->setDuration('600');

        $this->assertContains(
            '<video:duration><![CDATA[600]]></video:duration>',
            $this->item->build()
        );
    }


    public function testItShouldHaveDurationAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setDuration(-1);
    }


    public function testItShouldHaveRating()
    {
        $this->item->setRating(4.2);
        $this->assertContains(
            '<video:rating><![CDATA[4.2]]></video:rating>',
            $this->item->build()
        );
    }


    public function testItShouldHaveRatingAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setRating(-1);
    }


    public function testItShouldHaveViewCount()
    {
        $this->item->setViewCount(12345);

        $this->assertContains(
            '<video:view_count><![CDATA[12345]]></video:view_count>',
            $this->item->build()
        );
    }


    public function testItShouldHaveViewCountAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setViewCount(-1);
    }


    public function testItShouldHavePublicationDate()
    {
        $this->item->setPublicationDate('2007-11-05T19:20:30+08:00');

        $this->assertContains(
            '<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>',
            $this->item->build()
        );
    }


    public function testItShouldHavePublicationDateAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPublicationDate('');
    }


    public function testItShouldHaveFamilyFriendly()
    {
        $this->item->setFamilyFriendly('no');

        $this->assertContains(
            '<video:family_friendly><![CDATA[No]]></video:family_friendly>',
            $this->item->build()
        );
    }


    public function testItShouldHaveFamilyFriendlyAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setFamilyFriendly('');
    }


    public function testItShouldHaveRestriction()
    {
        $this->item->setRestriction('IE GB US CA');

        $this->assertContains(
            '<video:restriction>IE GB US CA</video:restriction>',
            $this->item->build()
        );
    }


    public function testItShouldHaveRestrictionAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setRestriction('AAA');
    }


    public function testItShouldHaveRestrictionRelationship()
    {
        $this->item->setRestriction('IE GB US CA', 'allow');
        $this->assertContains(
            '<video:restriction relationship="allow">IE GB US CA</video:restriction>',
            $this->item->build()
        );
    }


    public function testItShouldHaveRestrictionRelationshipAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setRestriction('IE GB US CA', '');
    }


    public function testItShouldHaveGalleryLoc()
    {
        $this->item->setGalleryLoc('http://cooking.example.com');

        $this->assertContains(
            '<video:gallery_loc>http://cooking.example.com</video:gallery_loc>',
            $this->item->build()
        );

        $this->item->setGalleryLoc('http://cooking.example.com', 'Cooking Videos');
        $this->assertContains(
            '<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>',
            $this->item->build()
        );
    }


    public function testItShouldHaveGalleryLocAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setGalleryLoc('');

        $this->setExpectedException($this->exception);
        $this->item->setGalleryLoc('http://cooking.example.com', '');
    }


    public function testItShouldHavePrice()
    {
        $this->item->setPrice(0.99, 'EUR');
        $this->item->setPrice(0.75, 'EUR');
        $this->assertContains('<video:price currency="EUR">0.99</video:price>', $this->item->build());
        $this->assertContains('<video:price currency="EUR">0.75</video:price>', $this->item->build());
    }


    public function testItShouldHavePriceAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPrice(-0.99, 'EUR');
    }


    public function testItShouldHavePriceCurrencyAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPrice(0.99, 'AAAA');
    }


    public function testItShouldHavePriceType()
    {
        $this->item->setPrice(0.99, 'EUR', 'rent');
        $this->item->setPrice(0.75, 'EUR', 'rent');
        $this->assertContains('<video:price currency="EUR" type="rent">0.99</video:price>', $this->item->build());
        $this->assertContains('<video:price currency="EUR" type="rent">0.75</video:price>', $this->item->build());
    }


    public function testItShouldHavePriceTypeAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPrice(0.75, 'EUR', 'AAAAA');
    }


    public function testItShouldHavePriceResolution()
    {
        $this->item->setPrice(0.99, 'EUR', 'rent', 'HD');
        $this->item->setPrice(0.75, 'EUR', 'rent', 'SD');
        $this->assertContains(
            '<video:price currency="EUR" type="rent" resolution="HD">0.99</video:price>',
            $this->item->build()
        );
        $this->assertContains(
            '<video:price currency="EUR" type="rent" resolution="SD">0.75</video:price>',
            $this->item->build()
        );
    }


    public function testItShouldHavePriceResolutionAndThrowException()
    {
        $this->setExpectedException($this->exception, 'Provided price resolution is not a valid value.');
        $this->item->setPrice(0.99, 'EUR', 'rent', 'AAAA');
    }


    public function testItShouldHaveCategory()
    {
        $this->item->setCategory('cooking');
        $this->assertContains('<video:category><![CDATA[cooking]]></video:category>', $this->item->build());
    }


    public function testItShouldHaveCategoryAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setCategory('');
    }


    public function testItShouldHaveTags()
    {
        $this->item->setTag(array('action', 'drama', 'entrepreneur'));
        $this->assertContains('<video:tag>drama</video:tag>', $this->item->build());
        $this->assertContains('<video:tag>action</video:tag>', $this->item->build());
        $this->assertContains('<video:tag>entrepreneur</video:tag>', $this->item->build());
    }


    public function testItShouldHaveTagsAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setTag([]);
    }


    public function testItShouldHaveRequiresSubscription()
    {
        $this->item->setRequiresSubscription('yes');
        $this->assertContains(
            '<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>',
            $this->item->build()
        );
    }


    public function testItShouldHaveRequiresSubscriptionAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setRequiresSubscription('');
    }


    public function testItShouldHaveLive()
    {
        $this->item->setLive('no');
        $this->assertContains('<video:live><![CDATA[no]]></video:live>', $this->item->build());
    }


    public function testItShouldHaveLiveAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setLive('');
    }


    public function testItShouldHaveUploader()
    {
        $this->item->setUploader('GrillyMcGrillerson');
        $this->assertContains('<video:uploader>GrillyMcGrillerson</video:uploader>', $this->item->build());
    }


    public function testItShouldHaveUploaderAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setUploader('');
    }


    public function testItShouldHaveUploaderInfo()
    {
        $this->item->setUploader('GrillyMcGrillerson', 'http://www.example.com/grillymcgrillerson');
        $this->assertContains(
            '<video:uploader info="http://www.example.com/grillymcgrillerson">GrillyMcGrillerson</video:uploader>',
            $this->item->build()
        );
    }


    public function testItShouldHaveUploaderInfoAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setUploader('GrillyMcGrillerson', '');
    }


    public function testItShouldHavePlatform()
    {
        $this->item->setPlatform('web mobile tv');
        $this->assertContains('<video:platform>web mobile tv</video:platform>', $this->item->build());
    }


    public function testItShouldHavePlatformAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPlatform('aaaa');
    }


    public function testItShouldHavePlatformRelationship()
    {
        $this->item->setPlatform('web mobile tv', 'allow');
        $this->assertContains(
            '<video:platform relationship="allow">web mobile tv</video:platform>',
            $this->item->build()
        );
    }


    public function testItShouldHavePlatformRelationshipAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPlatform('web mobile tv', 'AAAAAA');
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->item = new VideoItem(
            'Grilling steaks for summer',
            'http://www.example.com/video123.flv',
            'http://www.example.com/videoplayer.swf?video=123',
            'yes',
            'ap=1'
        );
    }
}
