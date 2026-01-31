<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrSite\Resources;

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
            'settings' => ['theme' => 'dark'],
        ]);

        $response = $this->api->agrSite->context->get('SITE001');

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

        $response = $this->api->agrSite->context->get('SITE002', ['include' => 'settings']);

        $this->assertIsArray($response->data);
        $this->assertEquals('SITE002', $response->data['siteId']);
    }
}
