<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInfo\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ContextResource.
 */
final class ContextResourceTest extends AugurApiTestCase
{
    public function testGet(): void
    {
        $this->mockResponse([
            'siteId' => 'SITE001',
            'domain' => 'example.com',
            'uid' => 1,
            'services' => ['items'],
            'serviceCount' => 1,
            'inactiveServices' => [],
        ]);

        $response = $this->api->agrInfo->context->get('SITE001');

        $this->assertIsArray($response->data);
        $this->assertEquals('SITE001', $response->data['siteId']);
        $this->assertEquals('example.com', $response->data['domain']);
        $this->assertRequestPath('/context/SITE001');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGetWithParams(): void
    {
        $this->mockResponse([
            'siteId' => 'SITE002',
            'siteName' => 'Another Site',
        ]);

        $response = $this->api->agrInfo->context->get('SITE002', ['include' => 'config']);

        $this->assertIsArray($response->data);
        $this->assertEquals('SITE002', $response->data['siteId']);
    }
}
