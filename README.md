# Augur API PHP Client

PHP client library for Augur API microservices.

## Installation

```bash
composer require simpleapps-com/augur-api
```

## Requirements

- PHP 8.3 or higher
- PSR-18 HTTP Client (Guzzle recommended)

## Quick Start

```php
<?php

use AugurApi\AugurApiClient;

$api = new AugurApiClient(
    siteId: 'your-site-id',
    bearerToken: 'your-token'
);

// List: query params are a plain array (camelCase names, as the API expects)
$response = $api->items->brands->list(['limit' => 10, 'orderBy' => 'brandsName']);
foreach ($response->data as $brand) {
    echo $brand['brandsName'] . "\n";
}

// Get single item: data is an array of the documented fields (the API may add more)
$brand = $api->items->brands->get(123);
echo $brand->data['brandsName'];

// Create: the body's required keys are checked by PHPStan (see the method docblock)
$newBrand = $api->items->brands->create([
    'brandsName' => 'New Brand',
    'brandsDesc' => 'A new brand',
]);

// Update
$updated = $api->items->brands->update(123, [
    'brandsName' => 'Updated Name',
]);

// Delete
$api->items->brands->delete(123);
```

## Documentation

Full documentation: https://augur-api.info

## Available Services

Every Augur service is a property of the client, named in camelCase: `$api->items`,
`$api->pricing`, `$api->agrInt`, `$api->openSearch`, and so on. Each resource method's
docblock lists its PHPStan request-body shape and the documented response fields.

## Custom HTTP Client

The SDK uses PSR-18 HTTP clients. By default, it auto-discovers an available client:

```php
use GuzzleHttp\Client as GuzzleClient;
use Nyholm\Psr7\Factory\Psr17Factory;

$factory = new Psr17Factory();

$api = new AugurApiClient(
    siteId: 'your-site-id',
    bearerToken: 'your-token',
    httpClient: new GuzzleClient(['timeout' => 60]),
    requestFactory: $factory,
    streamFactory: $factory,
);
```

## Error Handling

```php
use AugurApi\Core\Exceptions\AuthenticationException;
use AugurApi\Core\Exceptions\NotFoundException;
use AugurApi\Core\Exceptions\RateLimitException;
use AugurApi\Core\Exceptions\ValidationException;
use AugurApi\Core\Exceptions\AugurApiException;

try {
    $response = $api->items->brands->get(123);
} catch (AuthenticationException $e) {
    // 401 - Invalid credentials
} catch (NotFoundException $e) {
    // 404 - Not found
} catch (RateLimitException $e) {
    // 429 - Too many requests
} catch (ValidationException $e) {
    // 400 - Validation errors
    print_r($e->errors);
} catch (AugurApiException $e) {
    // Anything else, including 403, 5xx and network failures (code 0)
    echo $e->getCode(), $e->service, $e->endpoint; // e.g. 500 "items" "/brands/{brandsUid}"
}
```

`getCode()` is the HTTP status. `$e->service` is the kebab service name and `$e->endpoint`
the path template; messages never include parameter values.

## Endpoint Registry and `call()`

`AugurApiClient::endpoints()` lists every endpoint (id, method, path template, params). `call()` invokes one by id or alias id, with no typed method:

```php
$result = $api->call('items.invMast.doc.get', pathParams: ['invMastUid' => 12345], query: ['edgeCache' => 1]);

$result->httpStatus;       // 200
$result->envelope?->data;  // set when the body is the standard 8-key envelope
$result->body;             // decoded JSON, or the raw text when the body isn't JSON
```

- Arguments are checked before any request: path params must match exactly, query keys must be declared, and a body is allowed only on POST/PUT. Violations throw `InvalidArgumentException` (code 400).
- A 2xx always returns; there is no validation. Use the typed methods when you want typed responses.
- Non-2xx responses throw the same exceptions as the typed methods.

## Path Values

Path values are sent unencoded, because the API does not decode path segments (`/bins/D%2FS` looks up the literal `D%2FS`). A string path value MUST use only letters, digits and `- . _ ~ ! $ & ' ( ) * + , ; = : @`. Anything else, such as `/`, `?`, `#`, `%`, spaces or non-ASCII, throws `InvalidArgumentException` before any request. Pass the raw value, never a pre-encoded one. Use the query parameter instead where there is one:

```php
$api->items->locations->listBins(100, ['bin' => 'D/S']);  // not getBins(100, 'D/S')
```

## License

MIT
