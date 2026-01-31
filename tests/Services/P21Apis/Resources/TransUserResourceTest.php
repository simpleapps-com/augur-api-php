<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Apis\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for TransUserResource.
 *
 * @covers \AugurApi\Services\P21Apis\Resources\TransUserResource
 */
final class TransUserResourceTest extends AugurApiTestCase
{
    public function testCreate(): void
    {
        $this->mockResponse([
            'usersUid' => 1,
            'userName' => 'jdoe',
            'email' => 'test@example.com',
            'active' => true,
        ]);

        $response = $this->api->p21Apis->transUser->create([
            'userName' => 'jdoe',
            'email' => 'test@example.com',
            'active' => true,
        ]);

        $this->assertEquals(1, $response->data['usersUid']);
        $this->assertEquals('jdoe', $response->data['userName']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/trans-user');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'usersUid' => 1,
            'userName' => 'jdoe',
            'email' => 'test@example.com',
            'active' => true,
        ]);

        $response = $this->api->p21Apis->transUser->get(1);

        $this->assertEquals(1, $response->data['usersUid']);
        $this->assertEquals('jdoe', $response->data['userName']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/trans-user/1');
    }

    public function testGetWithParams(): void
    {
        $this->mockResponse([
            'usersUid' => 1,
            'userName' => 'jdoe',
            'permissions' => ['read', 'write'],
        ]);

        $response = $this->api->p21Apis->transUser->get(1, ['includePermissions' => true]);

        $this->assertEquals(1, $response->data['usersUid']);
        $this->assertCount(2, $response->data['permissions']);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'usersUid' => 1,
            'userName' => 'jdoe_updated',
            'email' => 'updated@example.com',
        ]);

        $response = $this->api->p21Apis->transUser->update(1, [
            'userName' => 'jdoe_updated',
            'email' => 'updated@example.com',
        ]);

        $this->assertEquals('jdoe_updated', $response->data['userName']);
        $this->assertEquals('updated@example.com', $response->data['email']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/trans-user/1');
    }

    public function testDelete(): void
    {
        $this->mockResponse([
            'success' => true,
        ]);

        $response = $this->api->p21Apis->transUser->delete(1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/trans-user/1');
    }
}
