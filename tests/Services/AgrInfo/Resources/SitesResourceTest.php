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

        $response = $this->api->agrInfo->sites->createValidate(['siteId' => 'abc']);

        $this->assertTrue($response->data['valid']);
        $this->assertRequestPath('/sites/validate');
        $this->assertRequestMethod('POST');
    }

    public function testCreateVerifyUser(): void
    {
        $this->mockResponse(['verified' => true, 'userId' => 7]);

        $response = $this->api->agrInfo->sites->createVerifyUser([
            'email' => 'user@example.com',
        ]);

        $this->assertTrue($response->data['verified']);
        $this->assertRequestPath('/sites/verify-user');
        $this->assertRequestMethod('POST');
    }
}
