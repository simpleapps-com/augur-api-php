<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInt\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for RolesResource.
 */
final class RolesResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['rolesUid' => 1, 'roleName' => 'admin'],
        ]);

        $response = $this->api->agrInt->roles->list();

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/roles');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse(['rolesUid' => 1, 'roleName' => 'admin']);

        $response = $this->api->agrInt->roles->create(['roleName' => 'admin']);

        $this->assertEquals('admin', $response->data['roleName']);
        $this->assertRequestPath('/roles');
        $this->assertRequestMethod('POST');
    }

    public function testGet(): void
    {
        $this->mockResponse(['rolesUid' => 1, 'roleName' => 'admin']);

        $response = $this->api->agrInt->roles->get(1);

        $this->assertEquals(1, $response->data['rolesUid']);
        $this->assertRequestPath('/roles/1');
        $this->assertRequestMethod('GET');
    }

    public function testUpdate(): void
    {
        $this->mockResponse(['rolesUid' => 1, 'roleName' => 'editor']);

        $response = $this->api->agrInt->roles->update(1, ['roleName' => 'editor']);

        $this->assertEquals('editor', $response->data['roleName']);
        $this->assertRequestPath('/roles/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['success' => true]);

        $this->api->agrInt->roles->delete(1);

        $this->assertRequestPath('/roles/1');
        $this->assertRequestMethod('DELETE');
    }
}
