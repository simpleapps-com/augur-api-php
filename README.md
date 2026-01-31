# Augur API PHP Client

PHP client library for Augur API microservices.

## Installation

```bash
composer require simpleapps-com/augur-api
```

## Requirements

- PHP 8.1 or higher
- PSR-18 HTTP Client (Guzzle recommended)

## Quick Start

```php
<?php

use AugurApi\AugurApiClient;
use AugurApi\Services\Items\Schemas\BrandsListParams;

$api = new AugurApiClient(
    siteId: 'your-site-id',
    bearerToken: 'your-token'
);

// List items with typed params
$params = new BrandsListParams(limit: 10, orderBy: 'brandName');
$response = $api->items->brands->list($params);
foreach ($response->data as $brand) {
    echo $brand->brandName . "\n";
}

// Get single item
$brand = $api->items->brands->get(123);
echo $brand->data->brandName;

// Create
$newBrand = $api->items->brands->create([
    'brandName' => 'New Brand',
    'brandDescription' => 'A new brand',
]);

// Update
$updated = $api->items->brands->update(123, [
    'brandName' => 'Updated Name',
]);

// Delete
$api->items->brands->delete(123);
```

## Documentation

Full documentation: https://augur-api.info

## Available Services

| Service | Access | Endpoints |
|---------|--------|-----------|
| Items | `$api->items` | 99 |
| More coming... | | |

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
