<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Apis\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for TransCompanyResource.
 *
 * @covers \AugurApi\Services\P21Apis\Resources\TransCompanyResource
 */
final class TransCompanyResourceTest extends AugurApiTestCase
{
    public function testCreate(): void
    {
        $this->mockResponse([
            'companyUid' => 1,
            'companyName' => 'Test Company',
            'active' => true,
        ]);

        $response = $this->api->p21Apis->transCompany->create([
            'companyName' => 'Test Company',
            'active' => true,
        ]);

        $this->assertEquals(1, $response->data['companyUid']);
        $this->assertEquals('Test Company', $response->data['companyName']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/trans-company');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'companyUid' => 1,
            'companyName' => 'Test Company',
            'active' => true,
        ]);

        $response = $this->api->p21Apis->transCompany->get(1);

        $this->assertEquals(1, $response->data['companyUid']);
        $this->assertEquals('Test Company', $response->data['companyName']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/trans-company/1');
    }

    public function testGetWithParams(): void
    {
        $this->mockResponse([
            'companyUid' => 1,
            'companyName' => 'Test Company',
        ]);

        $response = $this->api->p21Apis->transCompany->get(1, ['includeDetails' => true]);

        $this->assertEquals(1, $response->data['companyUid']);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'companyUid' => 1,
            'companyName' => 'Updated Company',
            'active' => false,
        ]);

        $response = $this->api->p21Apis->transCompany->update(1, [
            'companyName' => 'Updated Company',
            'active' => false,
        ]);

        $this->assertEquals('Updated Company', $response->data['companyName']);
        $this->assertFalse($response->data['active']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/trans-company/1');
    }

    public function testDelete(): void
    {
        $this->mockResponse([
            'success' => true,
        ]);

        $response = $this->api->p21Apis->transCompany->delete(1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/trans-company/1');
    }
}
