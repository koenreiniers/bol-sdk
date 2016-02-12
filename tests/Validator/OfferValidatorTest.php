<?php
namespace Kr\Bol\Tests\Model;

use Kr\Bol\Validator\OfferValidator;
use Kr\Bol\Model\Offer;
use Kr\Bol\Enum\Condition;
use Kr\Bol\Enum\DeliveryCode;

class OfferValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidation()
    {
        $validator = new OfferValidator();

        $id             = 1;
        $ean            = "1234567890123";
        $condition      = Condition::COND_AS_NEW;
        $price          = 3.50;
        $deliveryCode   = DeliveryCode::DC_12D;
        $quantityInStock= 150;
        $publish        = true;
        $referenceCode  = "foo";
        $description    = "bar";


        // Creation
        $offer = Offer::toCreate($id, $ean, $condition, $price, $deliveryCode, $quantityInStock, $publish, $referenceCode, $description);
        $validator->validateCreateOffer($offer);

        // Regular update
        $offer = Offer::toUpdate($id, $price, $deliveryCode, $publish, $referenceCode, $description);
        $validator->validateUpdateOffer($offer);

        // Stock update
        $offer = Offer::toUpdateStock($id, $quantityInStock);
        $validator->validateStockUpdate($offer);

        // Deletion
        $offer = Offer::toDelete($id);
        $validator->validateDelete($offer);

    }
}