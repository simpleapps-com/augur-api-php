<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInt\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for UsersResource.
 */
final class UsersResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['usersUid' => 5, 'username' => 'jdoe'],
        ]);

        $response = $this->api->agrInt->users->list();

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/users');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse(['usersUid' => 5, 'username' => 'jdoe']);

        $response = $this->api->agrInt->users->create(['username' => 'jdoe']);

        $this->assertEquals('jdoe', $response->data['username']);
        $this->assertRequestPath('/users');
        $this->assertRequestMethod('POST');
    }

    public function testCreateVerify(): void
    {
        $this->mockResponse(['usersUid' => 5, 'verified' => true]);

        $response = $this->api->agrInt->users->createVerify(['username' => 'jdoe', 'password' => 'x']);

        $this->assertTrue($response->data['verified']);
        $this->assertRequestPath('/users/verify');
        $this->assertRequestMethod('POST');
    }

    public function testCreateRotate(): void
    {
        $this->mockResponse(['token' => 'new-token']);

        $response = $this->api->agrInt->users->createRotate(['token' => 'old-token']);

        $this->assertSame('new-token', $response->data['token']);
        $this->assertRequestPath('/users/rotate');
        $this->assertRequestMethod('POST');
    }

    public function testCreateValidate(): void
    {
        $this->mockResponse(['valid' => true]);

        $response = $this->api->agrInt->users->createValidate(['token' => 'some-token']);

        $this->assertTrue($response->data['valid']);
        $this->assertRequestPath('/users/validate');
        $this->assertRequestMethod('POST');
    }

    public function testGet(): void
    {
        $this->mockResponse(['usersUid' => 5, 'username' => 'jdoe']);

        $response = $this->api->agrInt->users->get(5);

        $this->assertEquals(5, $response->data['usersUid']);
        $this->assertRequestPath('/users/5');
        $this->assertRequestMethod('GET');
    }

    public function testUpdate(): void
    {
        $this->mockResponse(['usersUid' => 5, 'username' => 'jdoe2']);

        $response = $this->api->agrInt->users->update(5, ['username' => 'jdoe2']);

        $this->assertEquals('jdoe2', $response->data['username']);
        $this->assertRequestPath('/users/5');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['success' => true]);

        $this->api->agrInt->users->delete(5);

        $this->assertRequestPath('/users/5');
        $this->assertRequestMethod('DELETE');
    }

    public function testListRoles(): void
    {
        $this->mockListResponse([
            ['usersXRolesUid' => 9, 'rolesUid' => 1],
        ]);

        $response = $this->api->agrInt->users->listRoles(5);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/users/5/roles');
        $this->assertRequestMethod('GET');
    }

    public function testCreateRoles(): void
    {
        $this->mockResponse(['usersXRolesUid' => 9, 'rolesUid' => 1]);

        $response = $this->api->agrInt->users->createRoles(5, ['rolesUid' => 1]);

        $this->assertEquals(1, $response->data['rolesUid']);
        $this->assertRequestPath('/users/5/roles');
        $this->assertRequestMethod('POST');
    }

    public function testGetRoles(): void
    {
        $this->mockResponse(['usersXRolesUid' => 9, 'rolesUid' => 1]);

        $response = $this->api->agrInt->users->getRoles(5, 9);

        $this->assertEquals(9, $response->data['usersXRolesUid']);
        $this->assertRequestPath('/users/5/roles/9');
        $this->assertRequestMethod('GET');
    }

    public function testUpdateRoles(): void
    {
        $this->mockResponse(['usersXRolesUid' => 9, 'rolesUid' => 2]);

        $response = $this->api->agrInt->users->updateRoles(5, 9, ['rolesUid' => 2]);

        $this->assertEquals(2, $response->data['rolesUid']);
        $this->assertRequestPath('/users/5/roles/9');
        $this->assertRequestMethod('PUT');
    }

    public function testDeleteRoles(): void
    {
        $this->mockResponse(['success' => true]);

        $this->api->agrInt->users->deleteRoles(5, 9);

        $this->assertRequestPath('/users/5/roles/9');
        $this->assertRequestMethod('DELETE');
    }
}
