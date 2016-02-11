<?php
namespace Kr\Bol\Tests\Http;

use Kr\Bol\Http\ExceptionHandler;

class ExceptionHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Kr\Bol\Exception\UnauthorizedException
     */
    public function testHandle401()
    {
        $exceptionHandler = new ExceptionHandler();
        $exceptionHandler->handleStatusCode(401);
    }

    /**
     * @expectedException \Kr\Bol\Exception\InvalidXmlException
     */
    public function testHandle400()
    {
        $exceptionHandler = new ExceptionHandler();
        $exceptionHandler->handleStatusCode(400);
    }

    /**
     * @expectedException \Kr\Bol\Exception\ApiLimitException
     */
    public function testHandle503()
    {
        $exceptionHandler = new ExceptionHandler();
        $exceptionHandler->handleStatusCode(503);
    }

    /**
     * @expectedException \Kr\Bol\Exception\ApiLimitException
     */
    public function testHandle409()
    {
        $exceptionHandler = new ExceptionHandler();
        $exceptionHandler->handleStatusCode(409);
    }
}