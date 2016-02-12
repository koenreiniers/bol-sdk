<?php
namespace Kr\Bol;

use Kr\Bol\Model\Offer;

interface PlazaInterface
{
    /**
     * Creates a new offer at Bol.com
     * @param Offer $offer
     * @return boolean
     */
    public function createOffer(Offer $offer);

    /**
     * Updates an existing offer at Bol.com
     * @param Offer $offer
     * @return boolean
     */
    public function updateOffer(Offer $offer);

    /**
     * Update an existing offer's quantity in stock
     * You can either input an id or an Offer model
     * @param Offer|int $offer
     * @param int|null $quantityInStock
     * @return boolean
     */
    public function updateOfferStock($offer, $quantityInStock = null);

    /**
     * Deletes an offer from Bol.com, you can either input an id or an Offer model
     * @param Offer|int $offerId
     * @return boolean
     */
    public function deleteOffer($offer);

    /**
     * Request new export file
     * @param null|string $filter
     * @return string The filename of the export file
     */
    public function requestExport($filter = null);


    /**
     * Read export file and return array of offers with headers as keys
     * @param string $filename
     * @return array
     */
    public function readExport($filename);

    /**
     * Retrieve array of currently open orders
     * @return array
     */
    public function getOpenOrders();
}