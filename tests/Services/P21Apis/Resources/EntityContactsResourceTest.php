<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Apis\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for EntityContactsResource.
 *
 * @covers \AugurApi\Services\P21Apis\Resources\EntityContactsResource
 */
final class EntityContactsResourceTest extends AugurApiTestCase
{
    public function testRefresh(): void
    {
        $this->mockResponse([
            'success' => true,
            'message' => 'Entity contacts refresh triggered',
        ]);

        $response = $this->api->p21Apis->entityContacts->refresh();

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/entity-contacts/refresh');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testRefreshWithParams(): void
    {
        $this->mockResponse([
            'success' => true,
            'count' => 100,
        ]);

        $response = $this->api->p21Apis->entityContacts->refresh(['forceUpdate' => true]);

        $this->assertTrue($response->data['success']);
        $this->assertEquals(100, $response->data['count']);
    }
}
