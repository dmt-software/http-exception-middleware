# Http Exception Middleware

PSR-15 middleware to transform http exceptions from _pavelsterba/http-exceptions_ to PSR-7 responses.

## Installation

```bash
composer require dmt-software/http-exception-middleware
```


## Usage 

```php
use DMT\Http\Exception\Middleware\HttpExceptionMiddleware;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/** @var ResponseFactoryInterface $httpExceptionMiddleware */
$httpExceptionMiddleware = new HttpExceptionMiddleware($responseFactory);

/** @var ServerRequestInterface $request */
/** @var RequestHandlerInterface $handler */
$httpExceptionMiddleware->process($request, $handler);

// if handler throws a HttpException/Exception it will be turned into a psr-7 response 
```
