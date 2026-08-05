<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInt\Resources;

use AugurApi\Services\AgrInt\Resources\ResourcesResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for ResourcesResource.
 */
#[CoversClass(ResourcesResource::class)]
final class ResourcesResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['resourcesUid' => 1, 'resourceId' => 'items'],
            ['resourcesUid' => 2, 'resourceId' => 'orders'],
        ]);

        $response = $this->api->agrInt->resources->list();

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('items', $data[0]['resourceId']);
        $this->assertRequestPath('/resources');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['resourcesUid' => 1, 'resourceId' => 'items'],
        ], 25);

        $response = $this->api->agrInt->resources->list(['limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(25, $response->total);
    }

    public function testCreate(): void
    {
        $this->mockResponse(['resourcesUid' => 3, 'resourceId' => 'pricing']);

        $response = $this->api->agrInt->resources->create(['resourceId' => 'pricing']);

        $this->assertEquals('pricing', $response->data['resourceId']);
        $this->assertRequestPath('/resources');
        $this->assertRequestMethod('POST');
    }

    public function testGet(): void
    {
        $this->mockResponse(['resourcesUid' => 1, 'resourceId' => 'items']);

        $response = $this->api->agrInt->resources->get(1);

        $this->assertEquals(1, $response->data['resourcesUid']);
        $this->assertRequestPath('/resources/1');
        $this->assertRequestMethod('GET');
    }

    public function testUpdate(): void
    {
        $this->mockResponse(['resourcesUid' => 1, 'resourceId' => 'renamed']);

        $response = $this->api->agrInt->resources->update(1, ['resourceId' => 'renamed']);

        $this->assertEquals('renamed', $response->data['resourceId']);
        $this->assertRequestPath('/resources/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['success' => true]);

        $this->api->agrInt->resources->delete(1);

        $this->assertRequestPath('/resources/1');
        $this->assertRequestMethod('DELETE');
    }
}
