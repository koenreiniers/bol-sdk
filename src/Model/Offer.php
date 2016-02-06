<?php
namespace Kr\Bol\Model;

class Offer
{
    /**
     * Return new Offer with all values set that are needed to create one
     * @param string $id
     * @param string $ean
     * @param string $condition
     * @param float $price
     * @param string $deliveryCode
     * @param int $quantityInStock
     * @param bool $publish
     * @param string|null $referenceCode
     * @param string|null $description
     * @return Offer
     */
    public static function toCreate($id, $ean, $condition, $price, $deliveryCode, $quantityInStock, $publish, $referenceCode, $description)
    {
        $offer = new self();
        $offer->setId($id);
        $offer->setEan($ean);
        $offer->setCondition($condition);
        $offer->setPrice($price);
        $offer->setDeliveryCode($deliveryCode);
        $offer->setQuantityInStock($quantityInStock);
        $offer->setPublish($publish);
        $offer->setReferenceCode($referenceCode);
        $offer->setDescription($description);
        return $offer;
    }

    /**
     * Return new Offer with all values set that are needed to update one
     * @param string $id
     * @param float $price
     * @param string $deliveryCode
     * @param bool $publish
     * @param string|null $referenceCode
     * @param string|null $description
     * @return Offer
     */
    public static function toUpdate($id, $price, $deliveryCode, $publish, $referenceCode, $description)
    {
        $offer = new self();
        $offer->setId($id);
        $offer->setPrice($price);
        $offer->setDeliveryCode($deliveryCode);
        $offer->setPublish($publish);
        $offer->setReferenceCode($referenceCode);
        $offer->setDescription($description);
        return $offer;
    }

    /**
     * Return new Offer with all values set that are needed to update its stock
     * @param string $id
     * @param int $quantityInStock
     * @return Offer
     */
    public static function toUpdateStock($id, $quantityInStock)
    {
        $offer = new self();
        $offer->setId($id);
        $offer->setQuantityInStock($quantityInStock);
        return $offer;
    }

    /**
     * Return new Offer with all values set that are needed to delete one
     * @param string $id
     * @return Offer
     */
    public static function toDelete($id)
    {
        $offer = new self();
        $offer->setId($id);
        return $offer;
    }

    private $id;
    private $ean;
    private $condition;
    private $price;
    private $deliveryCode;
    private $publish;
    private $referenceCode;
    private $description;
    private $quantityInStock;

    /**
     * @return mixed
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @param mixed $ean
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
    }

    /**
     * @return mixed
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param mixed $condition
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
    }

    /**
     * @return mixed
     */
    public function getQuantityInStock()
    {
        return $this->quantityInStock;
    }

    /**
     * @param mixed $quantityInStock
     */
    public function setQuantityInStock($quantityInStock)
    {
        $this->quantityInStock = $quantityInStock;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDeliveryCode()
    {
        return $this->deliveryCode;
    }

    /**
     * @param mixed $deliveryCode
     */
    public function setDeliveryCode($deliveryCode)
    {
        $this->deliveryCode = $deliveryCode;
    }

    /**
     * @return mixed
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * @param mixed $publish
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    }

    /**
     * @return mixed
     */
    public function getReferenceCode()
    {
        return $this->referenceCode;
    }

    /**
     * @param mixed $referenceCode
     */
    public function setReferenceCode($referenceCode)
    {
        $this->referenceCode = $referenceCode;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}