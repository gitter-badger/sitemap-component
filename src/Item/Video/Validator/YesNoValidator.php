<?php
namespace League\Sitemap\Item\Video\Validator;

class YesNoValidator extends AbstractYesNoValidator
{
    /**
     * @param string $confirmation
     *
     * @return string|false
     */
    public static function validate($confirmation)
    {
        return parent::validateMethod($confirmation, 'yes', 'no');
    }
}
