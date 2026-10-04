<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrSite\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for NotificationsResource.
 */
final class NotificationsResourceTest extends AugurApiTestCase
{
    public function testCreate(): void
    {
        $this->mockResponse([
            'notificationsUid' => 1,
            'serviceName' => 'orders',
            'type' => 'email',
        ]);

        $response = $this->api->agrSite->notifications->create([
            'serviceName' => 'orders',
            'dataTypeName' => 'oe_hdr',
            'type' => 'email',
        ]);

        $this->assertEquals(1, $response->data['notificationsUid']);
        $this->assertEquals('email', $response->data['type']);
        $this->assertRequestPath('/notifications');
        $this->assertRequestMethod('POST');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
