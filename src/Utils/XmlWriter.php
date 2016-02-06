<?php
namespace Kr\Bol\Utils;

use Kr\Bol\Model\Offer;

class XmlWriter
{
    /**
     * Generate Xml file from Offer
     * @param string $file
     * @param Offer $offer
     * @return string
     */
    public function write($file, Offer $offer)
    {
        ob_start();
        require_once($file);
        $output = ob_get_clean();
        return $output;
    }
}