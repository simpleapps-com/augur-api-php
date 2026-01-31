<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Apis\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for EntityCustomersResource.
 *
 * @covers \AugurApi\Services\P21Apis\Resources\EntityCustomersResource
 */
final class EntityCustomersResourceTest extends AugurApiTestCase
{
    public function testRefresh(): void
    {
        $this->mockResponse([
            'success' => true,
            'message' => 'Entity customers refresh triggered',
        ]);

        $response = $this->api->p21Apis->entityCustomers->refresh();

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/entity-customers/refresh');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testRefreshWithParams(): void
    {
        $this->mockResponse([
            'success' => true,
            'count' => 50,
        ]);

        $response = $this->api->p21Apis->entityCustomers->refresh(['forceUpdate' => true]);

        $this->assertTrue($response->data['success']);
        $this->assertEquals(50, $response->data['count']);
    }
}
