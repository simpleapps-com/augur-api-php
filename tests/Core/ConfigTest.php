<?php

declare(strict_types=1);

namespace AugurApi\Tests\Core;

use AugurApi\Core\Config;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    public function testConstructorSetsProperties(): void
    {
        $config = new Config(
            siteId: 'TEST123',
            bearerToken: 'test-token',
            timeout: 60000,
            retries: 5,
            retryDelay: 2000,
        );

        $this->assertEquals('TEST123', $config->siteId);
        $this->assertEquals('test-token', $config->bearerToken);
        $this->assertEquals(60000, $config->timeout);
        $this->assertEquals(5, $config->retries);
        $this->assertEquals(2000, $config->retryDelay);
    }

    public function testDefaultValues(): void
    {
        $config = new Config(
            siteId: 'TEST123',
            bearerToken: 'test-token',
        );

        $this->assertEquals(30000, $config->timeout);
        $this->assertEquals(3, $config->retries);
        $this->assertEquals(1000, $config->retryDelay);
    }

    public function testGetBaseUrlReturnsKnownService(): void
    {
        $config = new Config('TEST123', 'token');

        $this->assertEquals('https://items.augur-api.com', $config->getBaseUrl('items'));
        $this->assertEquals('https://customers.augur-api.com', $config->getBaseUrl('customers'));
    }

    public function testGetBaseUrlGeneratesUnknownService(): void
    {
        $config = new Config('TEST123', 'token');

        $this->assertEquals('https://unknown-service.augur-api.com', $config->getBaseUrl('unknownService'));
    }

    public function testCustomBaseUrls(): void
    {
        $config = new Config(
            siteId: 'TEST123',
            bearerToken: 'token',
            baseUrls: ['items' => 'https://custom.example.com'],
        );

        $this->assertEquals('https://custom.example.com', $config->getBaseUrl('items'));
        $this->assertEquals('https://customers.augur-api.com', $config->getBaseUrl('customers'));
    }
}
