<?php

namespace DMT\Http\Exception\Middleware;

use HttpException\BadRequestException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use GuzzleHttp\Psr7\Response;

class HttpExceptionMiddlewareTest extends TestCase
{
    public function testHttpExceptionResultsInHttpErrorResponse()
    {
        $request = $this->getMockForAbstractClass(ServerRequestInterface::class);

        $endpoint = $this->getMockForAbstractClass(RequestHandlerInterface::class);
        $endpoint->method('handle')->willThrowException(new BadRequestException());

        $responseFactory = $this->getMockForAbstractClass(ResponseFactoryInterface::class);
        $responseFactory->method('createResponse')->willReturnCallback(function($status, $reason) {
            return new Response($status, [], null, '1.1', $reason);
        });

        $middleware = new HttpExceptionMiddleware($responseFactory);

        $response = $middleware->process($request, $endpoint);

        $this->assertEquals(400, $response->getStatusCode());
    }
}
