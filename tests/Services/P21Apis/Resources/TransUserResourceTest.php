<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Apis\Resources;

use AugurApi\Services\P21Apis\Resources\TransUserResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for TransUserResource.
 */
#[CoversClass(TransUserResource::class)]
final class TransUserResourceTest extends AugurApiTestCase
{
    public function testGet(): void
    {
        $this->mockResponse([
            'usersUid' => 1,
            'userName' => 'jdoe',
            'email' => 'test@example.com',
            'active' => true,
        ]);

        $response = $this->api->p21Apis->transUser->get(1);

        $this->assertEquals(1, self::at($response->data, 'usersUid'));
        $this->assertEquals('jdoe', self::at($response->data, 'userName'));
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

        $this->assertEquals(1, self::at($response->data, 'usersUid'));
        $this->assertCount(2, self::arrayAt($response->data, 'permissions'));
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
