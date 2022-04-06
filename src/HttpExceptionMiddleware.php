<?php

namespace DMT\Http\Exception\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

/**
 * Class HttpExceptionMiddleware
 */
class HttpExceptionMiddleware implements MiddlewareInterface
{
    protected ResponseFactoryInterface $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch(\HttpException\Exception $httpException) {
            return $this->responseFactory->createResponse($httpException->getCode(), $httpException->getMessage());
        }
    }
}
