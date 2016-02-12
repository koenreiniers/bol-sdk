<?php
namespace Kr\Bol;

use Kr\Bol\Http\PlazaClient;
use Kr\Bol\Model\Offer;
use Kr\Bol\Utils\CsvParser;
use Kr\Bol\Utils\XmlParser;
use Kr\Bol\Utils\XmlWriter;
use Kr\Bol\Exception\ExportNotReadyException;
use Kr\Bol\Validator\OfferValidator;
use Kr\Bol\Mapper\OrderMapper;

class Plaza implements PlazaInterface
{
    public function __construct($publicKey, $privateKey, $isTestMode = false)
    {
        $this->publicKey        = $publicKey;
        $this->privateKey       = $privateKey;

        $this->client           = new PlazaClient($publicKey, $privateKey, $isTestMode);
        $this->xmlWriter        = new XmlWriter();
        $this->validator        = new OfferValidator();
        $this->xmlParser        = new XmlParser();
        $this->csvParser        = new CsvParser();
        $this->orderMapper      = new OrderMapper();
    }

    /**
     * @inheritdoc
     */
    public function getOpenOrders()
    {
        $target     = "/services/rest/orders/v1/open/";
        $response = $this->client->get($target);

        $xmlString = $response->getBody()->getContents();

        $orders = $this->orderMapper->map($xmlString);

        return $orders;
    }

    /**
     * @inheritdoc
     */
    public function createOffer(Offer $offer)
    {
        $this->validator->validateCreateOffer($offer);

        $content    = $this->xmlWriter->write(__DIR__."/Templates/offerCreate.xml", $offer);
        $target     = "/offers/v1/".$offer->getId();

        $response = $this->client->post($target, $content);

        return $response->getStatusCode() === 202;
    }

    /**
     * @inheritdoc
     */
    public function updateOffer(Offer $offer)
    {
        $this->validator->validateUpdateOffer($offer);

        $content    = $this->xmlWriter->write(__DIR__."/Templates/offerUpdate.xml", $offer);
        $target     = "/offers/v1/".$offer->getId();

        $response =  $this->client->put($target, $content);

        $isCreated = $response->getStatusCode() === 202;

        return $isCreated;
    }

    /**
     * @inheritdoc
     */
    public function updateOfferStock($offer, $quantityInStock = null)
    {
        if(!$offer instanceof Offer) {
            $offer = Offer::toUpdateStock($offer, $quantityInStock);
        }
        if($quantityInStock !== null) {
            $offer->setQuantityInStock($quantityInStock);
        }

        $this->validator->validateStockUpdate($offer);

        $content    = $this->xmlWriter->write(__DIR__."/Templates/stockUpdate.xml", $offer);
        $target     = "/offers/v1/".$offer->getId()."/stock";

        $response =  $this->client->put($target, $content);

        $isUpdated = $response->getStatusCode() === 202;

        return $isUpdated;
    }

    /**
     * @inheritdoc
     */
    public function deleteOffer($offer)
    {
        if(!$offer instanceof Offer) {
            $offer = Offer::toDelete($offer);
        }

        $this->validator->validateDelete($offer);

        $target = "/offers/v1/".$offer->getId();

        $response = $this->client->delete($target);

        $isDeleted = $response->getStatusCode() === 202;

        return $isDeleted;
    }

    /**
     * @inheritdoc
     */
    public function requestExport($filter = null)
    {
        $target = "/offers/v1/export";
        if($filter != null) {
            $target .= "?filter=".$filter;
        }

        $response = $this->client->get($target);
        $xmlString = $response->getBody(true);

        $output = $this->xmlParser->parse($xmlString);
        $exportFileUrl = $output['OfferFile']['Url'];
        $filename = substr($exportFileUrl, strrpos($exportFileUrl, '/') + 1);

        return $filename;
    }

    /**
     * @inheritdoc
     */
    public function readExport($filename)
    {
        $target = "/offers/v1/export/".$filename;
        $response = $this->client->get($target);

        if($response->getStatusCode() != 200) {
            throw new ExportNotReadyException();
        }

        $csvString = $response->getBody(true);
        $offers = $this->csvParser->parse($csvString);

        return $offers;
    }
}