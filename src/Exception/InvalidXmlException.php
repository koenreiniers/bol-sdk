<?php
namespace Kr\Bol\Exception;

class InvalidXmlException extends \Exception
{
    public function __construct($message = "Your request contains invalid XML", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}