<?php
namespace League\Sitemap\Item\Video\Validator;

final class FamilyFriendlyValidator
{
    /**
     * @param $familyFriendly
     *
     * @return string|false
     */
    public static function validate($familyFriendly)
    {
        if (false !== ($familyFriendly = YesNoValidator::validate($familyFriendly))) {
            return ucfirst($familyFriendly);
        }

        return false;
    }
}
