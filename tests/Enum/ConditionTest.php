<?php
namespace Kr\Bol\Tests\Enum;

use Kr\Bol\Enum\Condition;

class ConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testAllConditions()
    {
        $expectedAmount = 5;
        $actualAmount = count(Condition::all());
        $this->assertEquals($expectedAmount, $actualAmount);
    }
}