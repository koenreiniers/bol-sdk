<?php
namespace Kr\Bol\Tests\Assert;

use Kr\Bol\Assert\OfferAssertion;

class OfferAssertionTest extends \PHPUnit_Framework_TestCase
{
    public function testIdIsValid()
    {
        OfferAssertion::id("foo");
    }
    public function testIdIsNull()
    {
        $this->setExpectedException("InvalidArgumentException");
        OfferAssertion::id(null);
    }

    public function testPriceIsValid()
    {
        OfferAssertion::price(1500.50);
    }
    public function testPriceTooHigh()
    {
        $this->setExpectedException("InvalidArgumentException");
        OfferAssertion::price(10000);
    }
    public function testPriceTooLow()
    {
        $this->setExpectedException("InvalidArgumentException");
        OfferAssertion::price(0);
    }
    public function testPriceNotANumber()
    {
        $this->setExpectedException("InvalidArgumentException");
        OfferAssertion::price("foo");
    }

    public function testEanIsValid()
    {
        OfferAssertion::ean("1234567890123");
    }
    public function testEanIsInvalid()
    {
        $this->setExpectedException("InvalidArgumentException");
        OfferAssertion::ean("123456789012");
    }

    public function testConditionIsValid()
    {
        OfferAssertion::condition("AS_NEW");
    }
    public function testConditionIsInvalid()
    {
        $this->setExpectedException("InvalidArgumentException");
        OfferAssertion::condition("foo");
    }

    public function testDeliveryCodeIsValid()
    {
        OfferAssertion::deliveryCode("1-2d");
    }
    public function testDeliveryCodeIsInvalid()
    {
        $this->setExpectedException("InvalidArgumentException");
        OfferAssertion::deliveryCode("foo");
    }

    public function testDescriptionIsValid()
    {
        OfferAssertion::description("Lorem ipsum dolar sit amet.");
    }
    public function testDescriptionTooLong()
    {
        $description = str_repeat("a", 2001);
        $this->setExpectedException("InvalidArgumentException");
        OfferAssertion::description($description);
    }

    public function testReferenceCodeIsValid()
    {
        OfferAssertion::referenceCode("foo-bar");
    }
    public function testReferenceCodeTooLong()
    {
        $referenceCode = str_repeat("a", 21);
        $this->setExpectedException("InvalidArgumentException");
        OfferAssertion::referenceCode($referenceCode);
    }

    public function testPublishInvalid()
    {
        $this->setExpectedException("InvalidArgumentException");
        OfferAssertion::publish(1);
    }
    public function testPublishValid()
    {
        OfferAssertion::publish(true);
        OfferAssertion::publish(false);
    }

    public function testQuantityInStockIsValid()
    {
        OfferAssertion::quantityInStock(135);
    }
    public function testQuantityInStockTooLow()
    {
        $this->setExpectedException("InvalidArgumentException");
        OfferAssertion::quantityInStock(-1);
    }
    public function testQuantityInStockTooHigh()
    {
        $this->setExpectedException("InvalidArgumentException");
        OfferAssertion::quantityInStock(501);
    }
    public function testQuantityNoInteger()
    {
        $this->setExpectedException("InvalidArgumentException");
        OfferAssertion::quantityInStock(50.1);
    }
}