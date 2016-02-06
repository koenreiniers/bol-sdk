<?php
namespace Kr\Bol\Exception;

class ExportNotReadyException extends \Exception
{
    public function __construct($message = "The requested export file has not yet been fully generated.", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}