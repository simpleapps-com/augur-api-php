<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Apis\Resources;

use AugurApi\Services\P21Apis\Resources\EntityContactsResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for EntityContactsResource.
 */
#[CoversClass(EntityContactsResource::class)]
final class EntityContactsResourceTest extends AugurApiTestCase
{
    public function testRefresh(): void
    {
        $this->mockResponse([
            'success' => true,
            'message' => 'Entity contacts refresh triggered',
        ]);

        $response = $this->api->p21Apis->entityContacts->getRefresh();

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

        $response = $this->api->p21Apis->entityContacts->getRefresh(['forceUpdate' => true]);

        $this->assertTrue($response->data['success']);
        $this->assertEquals(100, $response->data['count']);
    }
}
