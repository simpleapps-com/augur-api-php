<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInfo\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for AgrInfo OauthResource.
 */
final class OauthResourceTest extends AugurApiTestCase
{
    public function testDeleteGrants(): void
    {
        $this->mockResponse([
            'success' => true,
            'revoked' => 'grant-123',
        ]);

        $response = $this->api->agrInfo->oauth->deleteGrants('grant-123');

        $this->assertTrue($response->data['success']);
        $this->assertRequestPath('/oauth/grants/grant-123');
        $this->assertRequestMethod('DELETE');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testCreateRefresh(): void
    {
        $this->mockResponse([
            'accessToken' => 'new-access-token',
            'expiresIn' => 3600,
        ]);

        $response = $this->api->agrInfo->oauth->createRefresh([
            'refreshToken' => 'old-refresh-token',
        ]);

        $this->assertEquals('new-access-token', $response->data['accessToken']);
        $this->assertRequestPath('/oauth/refresh');
        $this->assertRequestMethod('POST');
    }

    public function testCreateRefreshReturnsBaseResponse(): void
    {
        $this->mockResponse([
            'accessToken' => 'token',
        ]);

        $response = $this->api->agrInfo->oauth->createRefresh([
            'refreshToken' => 'refresh',
        ]);

        $this->assertEquals(200, $response->status);
        $this->assertIsArray($response->data);
    }
}
