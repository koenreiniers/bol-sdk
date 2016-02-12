<?php
namespace Kr\Bol\Tests\Utils;

use Kr\Bol\Utils\CsvParser;

class CsvParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $parser = new CsvParser();
        $csvString = "id,foo\n1,bar\n2,lorem\n";
        $output = $parser->parse($csvString);

        $expected = [
            ["id" => 1, "foo" => "bar"],
            ["id" => 2, "foo" => "lorem"],
        ];

        $this->assertEquals($expected, $output);
    }
}