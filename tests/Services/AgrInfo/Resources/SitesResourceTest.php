<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInfo\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for SitesResource.
 */
final class SitesResourceTest extends AugurApiTestCase
{
    public function testCreateValidate(): void
    {
        $this->mockResponse(['valid' => true]);

        $response = $this->api->agrInfo->sites->createValidate(['siteId' => 'abc', 'token' => 'jwt-token']);

        $this->assertTrue(self::at($response->data, 'valid'));
        $this->assertRequestPath('/sites/validate');
        $this->assertRequestMethod('POST');
    }

    public function testCreateStaffToken(): void
    {
        $this->mockResponse(['token' => 'jwt-token', 'siteId' => 'abc', 'username' => 'staff']);

        $response = $this->api->agrInfo->sites->createStaffToken(['siteId' => 'abc']);

        $this->assertSame('jwt-token', self::at($response->data, 'token'));
        $this->assertRequestPath('/sites/staff-token');
        $this->assertRequestMethod('POST');
    }
}
