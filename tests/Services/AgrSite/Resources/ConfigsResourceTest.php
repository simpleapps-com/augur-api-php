<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrSite\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ConfigsResource.
 */
final class ConfigsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['serviceName' => 'p21_sism'],
            ['serviceName' => 'items'],
        ]);

        $response = $this->api->agrSite->configs->list(['limit' => 10]);

        $this->assertCount(2, $response->data);
        $this->assertRequestPath('/configs');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse(['serviceName' => 'p21_sism']);

        $response = $this->api->agrSite->configs->get('p21_sism');

        $this->assertEquals('p21_sism', $response->data['serviceName']);
        $this->assertRequestPath('/configs/p21_sism');
        $this->assertRequestMethod('GET');
    }

    public function testUpdate(): void
    {
        $this->mockResponse(['serviceName' => 'p21_sism']);

        $response = $this->api->agrSite->configs->update('p21_sism', ['values' => ['import_enabled' => 'Y']]);

        $this->assertEquals('p21_sism', $response->data['serviceName']);
        $this->assertRequestPath('/configs/p21_sism');
        $this->assertRequestMethod('PUT');
    }
}
