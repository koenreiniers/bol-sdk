<?php
namespace Kr\Bol\Tests\Utils;

use Kr\Bol\Model\Offer;
use Kr\Bol\Utils\XmlWriter;

class XmlWriterTest extends \PHPUnit_Framework_TestCase
{
    public function testWrite()
    {
        $writer = new XmlWriter();
        $id = 1;
        $quantityInStock = 150;

        $filename = __DIR__."/../../src/Templates/stockUpdate.xml";

        $offer = Offer::toUpdateStock($id, $quantityInStock);


        $output = $writer->write($filename, $offer);
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<StockUpdate xmlns="http://plazaapi.bol.com/offers/xsd/api-1.0.xsd">
    <QuantityInStock>150</QuantityInStock>
</StockUpdate>
EOF;

        $this->assertEquals($expected, $output);
    }
}