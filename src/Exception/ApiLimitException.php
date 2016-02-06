<?php
namespace Kr\Bol\Exception;

class ApiLimitException extends \Exception
{
    public function __construct($message = "You have exceeded the bol API limit.", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}