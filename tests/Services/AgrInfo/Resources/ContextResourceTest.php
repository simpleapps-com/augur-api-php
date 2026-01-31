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
            'siteName' => 'Test Site',
            'config' => ['feature1' => true],
        ]);

        $response = $this->api->agrInfo->context->get('SITE001');

        $this->assertIsArray($response->data);
        $this->assertEquals('SITE001', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
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
