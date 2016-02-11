<?php
namespace Kr\Bol\Exception;

class UnauthorizedException extends \Exception
{
    public function __construct($message = "Authorization failed. Are your public and private key correct?", $code = null, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}