<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Core\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for CompanyResource.
 *
 * @covers \AugurApi\Services\P21Core\Resources\CompanyResource
 */
final class CompanyResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['companyUid' => 1, 'companyName' => 'Company A', 'active' => true],
            ['companyUid' => 2, 'companyName' => 'Company B', 'active' => true],
        ]);

        $response = $this->api->p21Core->company->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['companyUid']);
        $this->assertEquals('Company A', $response->data[0]['companyName']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/company');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['companyUid' => 1, 'companyName' => 'Company A'],
        ], 25);

        $response = $this->api->p21Core->company->list(['active' => true, 'limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(25, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'companyUid' => 1,
            'companyName' => 'Company A',
            'active' => true,
            'address' => '123 Main St',
            'phone' => '555-0100',
        ]);

        $response = $this->api->p21Core->company->get(1);

        $this->assertEquals(1, $response->data['companyUid']);
        $this->assertEquals('Company A', $response->data['companyName']);
        $this->assertTrue($response->data['active']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/company/1');
    }

    public function testGetWithParams(): void
    {
        $this->mockResponse([
            'companyUid' => 1,
            'companyName' => 'Company A',
            'locations' => [
                ['locationId' => 100, 'name' => 'Main Office'],
            ],
        ]);

        $response = $this->api->p21Core->company->get(1, ['includeLocations' => true]);

        $this->assertEquals(1, $response->data['companyUid']);
        $this->assertCount(1, $response->data['locations']);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
