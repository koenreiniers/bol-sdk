<?php
namespace Kr\Bol\Http;

use Guzzle\Http\Client as HttpClient;
use Guzzle\Http\Message\Response;

class PlazaClient
{
    const ENTRY_POINT = "https://plazaapi.bol.com";
    private $publicKey;
    private $privateKey;

    public function __construct($publicKey, $privateKey)
    {
        $this->publicKey = $publicKey;
        $this->privateKey = $privateKey;
        $this->exceptionHandler = new ExceptionHandler();
        $this->httpClient = new HttpClient();
        $this->headerGenerator = new HeaderGenerator();
    }

    /**
     * @param string $target
     * @return Response
     */
    public function get($target)
    {
        return $this->request("GET", $target);
    }

    /**
     * @param string $target
     * @return Response
     */
    public function delete($target)
    {
        return $this->request("DELETE", $target);
    }

    /**
     * @param string $target
     * @param string $content
     * @return Response
     */
    public function post($target, $content)
    {
        return $this->request("POST", $target, $content);
    }

    /**
     * @param string $target
     * @param string $content
     * @return Response
     */
    public function put($target, $content)
    {
        return $this->request("PUT", $target, $content);
    }

    /**
     * @param string $method
     * @param string $target
     * @param null|string $content
     * @return Response
     */
    public function request($method, $target, $content = null)
    {
        $headers    = $this->headerGenerator->generateHeaders($this->publicKey, $this->privateKey, $target, $method);
        $url        = self::ENTRY_POINT . $target;

        $request = $this->httpClient->createRequest($method, $url, $headers, $content);

        try {
            $response = $request->send();
        } catch(\Exception $e) {
            $this->exceptionHandler->handle($e);
        }

        return $response;
    }
}