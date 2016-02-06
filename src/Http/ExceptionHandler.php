<?php
namespace Kr\Bol\Http;

use Kr\Bol\Exception\UnauthorizedException;
use Kr\Bol\Exception\InvalidXmlException;
use Kr\Bol\Exception\ApiLimitException;
use Kr\Bol\Exception\BolException;

use Kr\Bol\Utils\XmlParser;

class ExceptionHandler
{
    public function __construct()
    {
        $this->xmlParser = new XmlParser();
    }

    /**
     * Captch known exceptions
     * @param \Exception $e
     * @throws ApiLimitException
     * @throws InvalidXmlException
     * @throws UnauthorizedException
     * @throws \Exception
     */
    public function handle(\Exception $e)
    {
        $response = $e->getResponse();

        $statusCode = $response->getStatusCode();

        if($statusCode == 401)
        {
            throw new UnauthorizedException("Authorization failed. Are your public and private key correct?");
        }
        else if($statusCode == 400)
        {
            throw new InvalidXmlException();
        }
        else if($statusCode == 503 || $statusCode == 409)
        {
            throw new ApiLimitException();
        }

        $body = $response->getBody(true);
        $message = $this->xmlParser->parse($body);

        if(isset($message['ErrorCode'])) {
            throw new BolException($message['ErrorCode'] . ": " . $message['ErrorMessage']);
        }


        throw new \Exception("Unknown error occurred. Status code: {$response->getStatusCode()}.");
    }
}