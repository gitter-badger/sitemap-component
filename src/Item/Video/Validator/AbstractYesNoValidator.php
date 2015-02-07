<?php
namespace League\Sitemap\Item\Video\Validator;

abstract class AbstractYesNoValidator
{
    /**
     * @param string $confirmation
     * @param string $positive
     * @param string $negative
     *
     * @return string|false
     */
    public static function validateMethod($confirmation, $positive, $negative)
    {
        $lowercase = strtolower($confirmation);
        if ($positive === $lowercase || $negative === $lowercase) {
            return $lowercase;
        }

        return false;
    }
}
