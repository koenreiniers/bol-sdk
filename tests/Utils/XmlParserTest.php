<?php
namespace Kr\Bol\Tests\Utils;

use Kr\Bol\Utils\XmlParser;

class XmlParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $parser = new XmlParser();
        $xmlString = "<wrapper><item><id>1</id><foo>bar</foo></item></wrapper>";
        $output = $parser->parse($xmlString);

        $expected = [
            "item" => [
                "id"    => 1,
                "foo"   => "bar",
            ],
        ];

        $this->assertEquals($expected, $output);
    }
}