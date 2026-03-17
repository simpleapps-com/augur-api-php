<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Joomla\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for UsersResource.
 */
final class UsersResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'username' => 'admin', 'name' => 'Admin User'],
            ['id' => 2, 'username' => 'editor', 'name' => 'Editor User'],
        ]);

        $response = $this->api->joomla->users->list();

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('admin', $data[0]['username']);
        $this->assertRequestPath('/users');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'username' => 'admin'],
        ]);

        $response = $this->api->joomla->users->list(['limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/users');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'id' => 3,
            'username' => 'newuser',
            'name' => 'New User',
            'email' => 'new@example.com',
        ], 201);

        $response = $this->api->joomla->users->create([
            'username' => 'newuser',
            'name' => 'New User',
            'email' => 'new@example.com',
            'password' => 'your-password',
        ]);

        $this->assertEquals(3, $response->data['id']);
        $this->assertRequestPath('/users');
        $this->assertRequestMethod('POST');
    }

    public function testCreateVerifyPassword(): void
    {
        $this->mockResponse([
            'valid' => true,
            'userId' => 1,
        ]);

        $response = $this->api->joomla->users->createVerifyPassword([
            'username' => 'admin',
            'password' => 'your-password',
        ]);

        $this->assertTrue($response->data['valid']);
        $this->assertRequestPath('/users/verify-password');
        $this->assertRequestMethod('POST');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'id' => 1,
            'username' => 'admin',
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $response = $this->api->joomla->users->get(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertEquals('admin', $response->data['username']);
        $this->assertRequestPath('/users/1');
        $this->assertRequestMethod('GET');
    }

    public function testUpdate(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->joomla->users->update(1, ['name' => 'Updated Admin']);

        $this->assertTrue($response->data['success']);
        $this->assertRequestPath('/users/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->joomla->users->delete(1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestPath('/users/1');
        $this->assertRequestMethod('DELETE');
    }

    public function testListDoc(): void
    {
        $this->mockResponse([
            'id' => 1,
            'username' => 'admin',
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $response = $this->api->joomla->users->listDoc(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertRequestPath('/users/1/doc');
        $this->assertRequestMethod('GET');
    }

    public function testGetDocAlias(): void
    {
        $this->mockResponse([
            'id' => 1,
            'username' => 'admin',
            'registerDate' => '2024-01-01',
            'lastvisitDate' => '2024-01-15',
        ]);

        $response = $this->api->joomla->users->getDoc(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertRequestPath('/users/1/doc');
        $this->assertRequestMethod('GET');
    }

    public function testListGroups(): void
    {
        $this->mockListResponse([
            ['id' => 2, 'title' => 'Registered'],
            ['id' => 3, 'title' => 'Administrator'],
        ]);

        $response = $this->api->joomla->users->listGroups(1);

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Registered', $data[0]['title']);
        $this->assertRequestPath('/users/1/groups');
        $this->assertRequestMethod('GET');
    }

    public function testCreateGroups(): void
    {
        $this->mockResponse([
            'userId' => 1,
            'groups' => [2, 3],
        ]);

        $response = $this->api->joomla->users->createGroups(1, ['groups' => [2, 3]]);

        $this->assertEquals([2, 3], $response->data['groups']);
        $this->assertRequestPath('/users/1/groups');
        $this->assertRequestMethod('POST');
    }

    public function testGetGroups(): void
    {
        $this->mockResponse([
            'id' => 3,
            'title' => 'Administrator',
            'parent_id' => 1,
        ]);

        $response = $this->api->joomla->users->getGroups(3, 1);

        $this->assertEquals(3, $response->data['id']);
        $this->assertEquals('Administrator', $response->data['title']);
        $this->assertRequestPath('/users/1/groups/3');
        $this->assertRequestMethod('GET');
    }

    public function testListTrinity(): void
    {
        $this->mockResponse([
            'id' => 1,
            'username' => 'admin',
            'trinityId' => 'trinity-123',
            'trinityStatus' => 'active',
        ]);

        $response = $this->api->joomla->users->listTrinity(1);

        $this->assertEquals('trinity-123', $response->data['trinityId']);
        $this->assertRequestPath('/users/1/trinity');
        $this->assertRequestMethod('GET');
    }
}
