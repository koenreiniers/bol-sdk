<?php
namespace Kr\Bol\Validator;

use Kr\Bol\Assert\OfferAssertion as Assert;
use Kr\Bol\Model\Offer;

class OfferValidator
{
    /**
     * Validate Offer model when it is used to create a Bol offer
     * @param Offer $offer
     */
    public function validateCreateOffer(Offer $offer)
    {
        Assert::id($offer->getId());
        Assert::ean($offer->getEan());
        Assert::condition($offer->getCondition());
        Assert::price($offer->getPrice());
        Assert::deliveryCode($offer->getDeliveryCode());
        Assert::quantityInStock($offer->getQuantityInStock());
        Assert::publish($offer->getPublish());
        Assert::referenceCode($offer->getReferenceCode());
        Assert::description($offer->getDescription());
    }

    /**
     * Validate Offer model when it is used to update a Bol offer
     * @param Offer $offer
     */
    public function validateUpdateOffer(Offer $offer)
    {
        Assert::id($offer->getId());
        Assert::price($offer->getPrice());
        Assert::deliveryCode($offer->getDeliveryCode());
        Assert::publish($offer->getPublish());
        Assert::referenceCode($offer->getReferenceCode());
        Assert::description($offer->getDescription());
    }

    /**
     * Validate Offer model when it is used to update a Bol offer's stock
     * @param Offer $offer
     */
    public function validateStockUpdate(Offer $offer)
    {
        Assert::id($offer->getId());
        Assert::quantityInStock($offer->getQuantityInStock());
    }

    /**
     * Validate Offer model when it is used to delete an offer
     * @param Offer $offer
     */
    public function validateDelete(Offer $offer)
    {
        Assert::id($offer->getId());
    }
}