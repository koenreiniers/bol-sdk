<?php
namespace Kr\Bol\Tests\Enum;

use Kr\Bol\Enum\DeliveryCode;

class DeliveryCodeTest extends \PHPUnit_Framework_TestCase
{
    public function testAllDeliveryCodes()
    {
        $expectedAmount = 17;
        $actualAmount = count(DeliveryCode::all());
        $this->assertEquals($expectedAmount, $actualAmount);
    }
}