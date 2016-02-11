<?php
namespace Kr\Bol\Assert;

use Assert\Assertion as Assert;
use Kr\Bol\Enum\Condition;
use Kr\Bol\Enum\DeliveryCode;

class OfferAssertion
{
    /**
     * Validate id:
     * $id !== null
     * @param $id
     */
    public static function id($id)
    {
        Assert::notNull($id);
    }

    /**
     * Validate price:
     * 0 < $price < 10000
     * @param $price
     */
    public static function price($price)
    {
        Assert::numeric($price);
        Assert::greaterThan($price, 0);
        Assert::lessThan($price, 10000);
    }

    /**
     * Validate EAN:
     * length = 13
     * @param string $ean
     */
    public static function ean($ean)
    {
        Assert::length($ean, 13);
    }

    /**
     * Validate a condition:
     * Valid Bol condition
     * @param string $condition
     */
    public static function condition($condition)
    {
        Assert::inArray($condition, Condition::all());
    }

    /**
     * Validate delivery code:
     * Valid Bol delivery code
     * @param string $deliveryCode
     */
    public static function deliveryCode($deliveryCode)
    {
        Assert::inArray($deliveryCode, DeliveryCode::all());
    }

    /**
     * Validate description:
     * Length <= 2000
     * @param string $description
     */
    public static function description($description)
    {
        Assert::maxLength($description, 2000);
    }

    /**
     * Validate reference code:
     * Length <= 20
     * @param string $referenceCode
     */
    public static function referenceCode($referenceCode)
    {
        Assert::maxLength($referenceCode, 20);
    }

    /**
     * Validate boolean:
     * true or false
     * @param boolean $publish
     */
    public static function publish($publish)
    {
        Assert::boolean($publish);
    }

    /**
     * Validate quantity in stock:
     * 0 <= $quantityInStock <= 500
     * @param int $quantityInStock
     */
    public static function quantityInStock($quantityInStock)
    {
        Assert::integer($quantityInStock);
        Assert::min($quantityInStock, 0);
        Assert::max($quantityInStock, 500);
    }
}