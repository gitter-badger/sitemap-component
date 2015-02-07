<?php
namespace League\Sitemap\Item\Video\Validator;

class AllowDenyValidator extends AbstractYesNoValidator
{
    /**
     * @param string $confirmation
     *
     * @return string|false
     */
    public static function validate($confirmation)
    {
        return parent::validateMethod($confirmation, 'allow', 'deny');
    }
}
