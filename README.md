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
use AugurApi\Core\Exceptions\RateLimitException;
use AugurApi\Core\Exceptions\ValidationException;
use AugurApi\Core\Exceptions\AugurApiException;

try {
    $response = $api->items->brands->get(123);
} catch (AuthenticationException $e) {
    // 401/403 - Invalid credentials
} catch (RateLimitException $e) {
    // 429 - Too many requests
} catch (ValidationException $e) {
    // 400 - Validation errors
    print_r($e->errors);
} catch (AugurApiException $e) {
    // Other API errors
}
```

## License

MIT
