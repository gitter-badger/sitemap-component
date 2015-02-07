<?php

namespace League\Sitemap\Item;

abstract class AbstractItem implements ItemInterface
{
    /**
     * @var array
     */
    protected static $xml = [];

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    public function build()
    {
        $xml  = array_filter(self::$xml);
        $data = implode("", $xml);

        return $data."\n";
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    abstract protected function reset();

    /**
     * @param mixed  $value
     * @param string $name
     * @param bool   $cdata
     * @param string $tag
     * @param mixed  $validationClass
     * @param string $validationMethod
     * @param string $exceptionMsg
     */
    protected static function writeFullTag(
        $value,
        $name,
        $cdata,
        $tag,
        $validationClass,
        $validationMethod,
        $exceptionMsg
    ) {
        $value = self::validateInput($value, $validationClass, $validationMethod, $exceptionMsg);
        self::writeFullTagTemplate($value, $name, $cdata, $tag);
    }

    /**
     * @param         $value
     * @param string  $name
     * @param boolean $cdata
     * @param string  $tag
     */
    protected static function writeFullTagTemplate($value, $name, $cdata, $tag)
    {
        $xml = "<{$tag}>$value</{$tag}>";
        if ($cdata) {
            $xml = "<{$tag}><![CDATA[$value]]></{$tag}>";
        }
        self::$xml[$name] .= $xml;
    }

    /**
     * @param mixed  $value
     * @param string $name
     * @param string $attributeName
     * @param mixed  $validationClass
     * @param string $validationMethod
     * @param string $exceptionMsg
     */
    protected static function writeAttribute(
        $value,
        $name,
        $attributeName,
        $validationClass,
        $validationMethod,
        $exceptionMsg
    ) {
        list() = func_get_args();
        $value = self::validateInput($value, $validationClass, $validationMethod, $exceptionMsg);
        self::$xml[$name] .= " {$attributeName}=\"{$value}\"";
    }

    /**
     * @param mixed  $value
     * @param mixed  $validationClass
     * @param string $validationMethod
     * @param string $exceptionMsg
     *
     * @return mixed
     * @throws \InvalidArgumentException
     */
    protected static function validateInput($value, $validationClass, $validationMethod, $exceptionMsg)
    {
        $value = call_user_func_array([$validationClass, $validationMethod], [$value]);
        if (false === $value) {
            throw new \InvalidArgumentException($exceptionMsg);
        }

        return $value;
    }
}
