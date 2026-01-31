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
            'notificationUid' => 1,
            'type' => 'email',
            'recipient' => 'test@example.com',
            'status' => 'sent',
        ]);

        $response = $this->api->agrSite->notifications->create([
            'type' => 'email',
            'recipient' => 'test@example.com',
            'subject' => 'Test Notification',
            'body' => 'This is a test notification message.',
        ]);

        $this->assertEquals(1, $response->data['notificationUid']);
        $this->assertEquals('email', $response->data['type']);
        $this->assertEquals('sent', $response->data['status']);
        $this->assertRequestPath('/notifications');
        $this->assertRequestMethod('POST');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testCreateSmsNotification(): void
    {
        $this->mockResponse([
            'notificationUid' => 2,
            'type' => 'sms',
            'recipient' => '+15551234567',
            'status' => 'queued',
        ]);

        $response = $this->api->agrSite->notifications->create([
            'type' => 'sms',
            'recipient' => '+15551234567',
            'body' => 'Test SMS notification',
        ]);

        $this->assertEquals(2, $response->data['notificationUid']);
        $this->assertEquals('sms', $response->data['type']);
        $this->assertEquals('queued', $response->data['status']);
    }
}
