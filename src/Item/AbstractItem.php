<?php

namespace League\Sitemap\Item;

abstract class AbstractItem implements ItemInterface
{
    /**
     * @var array
     */
    protected $xml = [];

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    public function build()
    {
        $xml  = array_filter($this->xml);
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
    protected function writeFullTag(
        $value,
        $name,
        $cdata,
        $tag,
        $validationClass,
        $validationMethod,
        $exceptionMsg
    ) {
        $value = $this->validateInput($value, $validationClass, $validationMethod, $exceptionMsg);
        $this->writeFullTagTemplate($value, $name, $cdata, $tag);
    }

    /**
     * @param         $value
     * @param string  $name
     * @param boolean $cdata
     * @param string  $tag
     */
    protected function writeFullTagTemplate($value, $name, $cdata, $tag)
    {
        $xml = "<{$tag}>$value</{$tag}>";
        if ($cdata) {
            $xml = "<{$tag}><![CDATA[$value]]></{$tag}>";
        }
        $this->xml[$name] .= $xml;
    }

    /**
     * @param mixed  $value
     * @param string $name
     * @param string $attributeName
     * @param mixed  $validationClass
     * @param string $validationMethod
     * @param string $exceptionMsg
     */
    protected function writeAttribute(
        $value,
        $name,
        $attributeName,
        $validationClass,
        $validationMethod,
        $exceptionMsg
    ) {
        list() = func_get_args();
        $value = $this->validateInput($value, $validationClass, $validationMethod, $exceptionMsg);
        $this->xml[$name] .= " {$attributeName}=\"{$value}\"";
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
    protected function validateInput($value, $validationClass, $validationMethod, $exceptionMsg)
    {
        $value = call_user_func_array([$validationClass, $validationMethod], [$value]);
        if (false === $value) {
            throw new \InvalidArgumentException($exceptionMsg);
        }

        return $value;
    }
}
