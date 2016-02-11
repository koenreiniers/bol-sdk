<?php
namespace Kr\Bol\Http;

use Kr\Bol\Exception\UnauthorizedException;
use Kr\Bol\Exception\InvalidXmlException;
use Kr\Bol\Exception\ApiLimitException;
use Kr\Bol\Exception\BolException;
use GuzzleHttp\Exception\RequestException;

use Kr\Bol\Utils\XmlParser;

class ExceptionHandler
{
    public function __construct()
    {
        $this->xmlParser = new XmlParser();
    }

    /**
     * Captch known exceptions
     * @param RequestException $e
     * @throws BolException
     * @throws \Exception
     */
    public function handle(RequestException $e)
    {
        $response   = $e->getResponse();
        $statusCode = $response->getStatusCode();

        $this->handleStatusCode($statusCode);

        $body       = $response->getBody(true);
        $message    = $this->xmlParser->parse($body);

        if(isset($message['ErrorCode'])) {
            throw new BolException($message['ErrorMessage'], $message['ErrorCode']);
        }

        throw new \Exception("Unknown error occurred. Status code: {$response->getStatusCode()}.");
    }

    /**
     * Handle known HTTP response status codes
     * @param integer $statusCode
     * @throws ApiLimitException
     * @throws InvalidXmlException
     * @throws UnauthorizedException
     */
    public function handleStatusCode($statusCode)
    {
        if($statusCode == 401)
        {
            throw new UnauthorizedException();
        }
        else if($statusCode == 400)
        {
            throw new InvalidXmlException();
        }
        else if($statusCode == 503 || $statusCode == 409)
        {
            throw new ApiLimitException();
        }
    }
}