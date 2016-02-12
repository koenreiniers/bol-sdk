<?php
namespace Kr\Bol\Tests\Http;

use Kr\Bol\Http\HeaderGenerator;

class HeaderGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateHeaders()
    {
        $headerGenerator = new HeaderGenerator();

        // Example request from bol.com
        $publicKey  = "publicexamplekey";
        $privateKey = "privateexamplekey";
        $target     = "/services/rest/utils/v3/ping";
        $method     = "POST";
        $date       = "Fri, 07 Oct 2011 13:24:01 GMT";
        $headers = $headerGenerator->generateHeaders($publicKey, $privateKey, $target, $method, $date);

        $expectedHeaders = [
            "Content-type"          => "application/xml; charset=UTF-8",
            "X-BOL-Date"            => "Fri, 07 Oct 2011 13:24:01 GMT",
            "X-BOL-Authorization"   => "publicexamplekey:7ZHDSYabavdvIG0N4h1py//u3n/UNaqKdqblLhquMig="
        ];

        $this->assertEquals($expectedHeaders, $headers);

    }
}