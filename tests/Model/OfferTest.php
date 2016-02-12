<?php
namespace Kr\Bol\Tests\Model;

use Kr\Bol\Model\Offer;
use Kr\Bol\Enum\Condition;
use Kr\Bol\Enum\DeliveryCode;

class OfferTest extends \PHPUnit_Framework_TestCase
{
    public function testOfferCreation()
    {
        $id = 1;
        $ean = "1234567890123";
        $condition = Condition::COND_AS_NEW;
        $price = 3.50;
        $deliveryCode = DeliveryCode::DC_12D;
        $quantityInStock = 150;
        $publish = true;
        $referenceCode = "foo";
        $description = "bar";


        // Creation
        $offer = Offer::toCreate($id, $ean, $condition, $price, $deliveryCode, $quantityInStock, $publish, $referenceCode, $description);
        $this->assertEquals($id, $offer->getId());
        $this->assertEquals($ean, $offer->getEan());
        $this->assertEquals($condition, $offer->getCondition());
        $this->assertEquals($price, $offer->getPrice());
        $this->assertEquals($deliveryCode, $offer->getDeliveryCode());
        $this->assertEquals($quantityInStock, $offer->getQuantityInStock());
        $this->assertEquals($publish, $offer->getPublish());
        $this->assertEquals($referenceCode, $offer->getReferenceCode());
        $this->assertEquals($description, $offer->getDescription());

        // Regular update
        $offer = Offer::toUpdate($id, $price, $deliveryCode, $publish, $referenceCode, $description);
        $this->assertEquals($id, $offer->getId());
        $this->assertEquals($price, $offer->getPrice());
        $this->assertEquals($deliveryCode, $offer->getDeliveryCode());
        $this->assertEquals($publish, $offer->getPublish());
        $this->assertEquals($referenceCode, $offer->getReferenceCode());
        $this->assertEquals($description, $offer->getDescription());

        // Stock update
        $offer = Offer::toUpdateStock($id, $quantityInStock);
        $this->assertEquals($id, $offer->getId());
        $this->assertEquals($quantityInStock, $offer->getQuantityInStock());

        // Deletion
        $offer = Offer::toDelete($id);
        $this->assertEquals($id, $offer->getId());

    }
}