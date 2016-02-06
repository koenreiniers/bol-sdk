<?php
namespace Kr\Bol\Http;

class HeaderGenerator
{
    /**
     * Generate request headers
     * @param string $privateKey
     * @param string $publicKey
     * @param string $target
     * @param string $date
     * @param string $method
     * @param string $contentType
     * @return array
     */
    public function generateHeaders($publicKey, $privateKey, $target, $method)
    {
        $date           = gmdate("D, d M Y H:i:s T");
        $contentType    = "application/xml; charset=UTF-8";

        $headers = [
            "Content-type"          => $contentType,
            "X-BOL-Date"            => $date,
            "X-BOL-Authorization"   => $this->generateAuthorizationHeader($publicKey, $privateKey, $target, $date, $method, $contentType),
        ];

        return $headers;
    }

    /**
     * Generate authorization header
     * @param string $privateKey
     * @param string $publicKey
     * @param string $target
     * @param string $date
     * @param string $method
     * @param string $contentType
     * @return string
     */
    private function generateAuthorizationHeader($publicKey, $privateKey, $target, $date, $method, $contentType)
    {
        $signatureElements  = [];
        $signatureElements[] = strtoupper($method)."\n";
        $signatureElements[] = $contentType;
        $signatureElements[] = $date;
        $signatureElements[] = "x-bol-date:".$date;
        $signatureElements[] = $target;

        $signatureString = implode("\n", $signatureElements);

        $signature = $publicKey.':';
        $signature .= base64_encode(hash_hmac('SHA256', $signatureString, $privateKey, true));

        return $signature;
    }
}