# bol-sdk
SDK for the Bol API
## About
Since there is not yet an SDK available for the new part of the Bol Plaza API (offer management), I decided to create one. That means this SDK does supports neither orders nor the Bol Open Api. However, they MIGHT be added in the future.
You are however free to extend this SDK to your likings or event submit a pull request.
## Installation
```
composer require koenreiniers/bol-sdk
```
## Usage
There are two ways to use the SDK. The recommended way is using `Kr\Bol\Plaza`, which has predefined methods for each API call.
You can use it as follows:
```php
use \Kr\Bol\Plaza;
use \Kr\Model\Offer;

$plaza = new Plaza($publicKey, $privateKey);
// Create an offer
// Note you can also create an Offer model the old fashioned way using getters/setters
$offer = Offer::toCreate($id, $ean, $condition, $price, $deliveryCode, $quantityInStock, $publish, $referenceCode, $description);
$plaza->createOffer($offer);

// Update an offer
$offer = Offer::toUpdate($id, $price, $deliveryCode, $publish, $referenceCode, $description);
$plaza->updateOffer($offer);

// Update an offer's stock
$offer = Offer::toUpdate($id, $quantityInStock);
$plaza->updateOfferStock($offer);
// Alternatively:
$plaza->updateOfferStock($id, $quantityInStock);

// Delete an offer
$offer = Offer::toDelete($id);
$plaza->deleteOffer($offer);
// Alternatively:
$plaza->deleteOffer($id);

// Request an export of your offers
$exportFilename = $plaza->requestExport($filter);
// Try to read an export
$offers = $plaza->readExport($exportFilename);
```
### PlazaClient
Alternatively you can use `\Kr\Bol\Http\PlazaClient`, which can be used for any Plaza api call:
```php
use \Kr\Bol\Http\PlazaClient;

$plazaClient = new PlazaClient($publicKey, $privateKey);
$plazaClient->get("/offers/v1");
$plazaClient->post("/offers/v1", $content);
$plazaClient->put("/offers/v1", $content);
$plazaClient->delete("/offers/v1");
```
The downside of using `\Kr\Bol\PlazaClient` is that it doesn't validate your offers against Bol.com's predefined rules, which `\Kr\Bol\Plaza` does.
### Other
There's also a few more things like the Enums for conditions and delivery codes. They are primarily used to validate offers, but you can also use them to list all the available conditions and delivery codes:
```php
use \Kr\Bol\Enum\Condition;
use \Kr\Bol\Enum\DeliveryCode;

$conditions = Condition::all();
$deliveryCodes = DeliveryCode::all();

```
And let's not forget the `HeaderGenerator`:
```php
$headerGenerator = new \Kr\Bol\Http\HeaderGenerator();
$headers = $headerGenerator->generateHeaders($publicKey, $privateKey, $target, $method);
```

## Tests
There are no tests as of yet. Sorry.