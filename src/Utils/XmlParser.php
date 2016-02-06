<?php
namespace Kr\Bol\Utils;

class XmlParser
{
    /**
     * Convert xml string to array
     * @param string $xmlString
     * @return array
     */
    public function parse($xmlString)
    {
        $xml = simplexml_load_string($xmlString);
        $json = json_encode($xml);
        $array = json_decode($json, true);

        return $array;
    }
}