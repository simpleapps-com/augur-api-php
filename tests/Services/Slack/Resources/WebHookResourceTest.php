<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Slack\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for Slack WebHookResource.
 */
final class WebHookResourceTest extends AugurApiTestCase
{
    public function testCreate(): void
    {
        $this->mockResponse([
            'success' => true,
            'messageId' => 'msg_12345',
            'channel' => '#general',
        ]);

        $response = $this->api->slack->webHook->create([
            'channel' => '#general',
            'text' => 'Hello from Augur API!',
            'username' => 'Augur Bot',
        ]);

        $this->assertTrue($response->data['success']);
        $this->assertEquals('msg_12345', $response->data['messageId']);
        $this->assertEquals('#general', $response->data['channel']);
        $this->assertRequestPath('/web-hook');
        $this->assertRequestMethod('POST');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testCreateWithBlocks(): void
    {
        $this->mockResponse([
            'success' => true,
            'messageId' => 'msg_67890',
        ]);

        $response = $this->api->slack->webHook->create([
            'channel' => '#alerts',
            'blocks' => [
                [
                    'type' => 'section',
                    'text' => [
                        'type' => 'mrkdwn',
                        'text' => '*Alert*: System notification',
                    ],
                ],
            ],
        ]);

        $this->assertTrue($response->data['success']);
        $this->assertEquals('msg_67890', $response->data['messageId']);
    }

    public function testCreateReturnsBaseResponse(): void
    {
        $this->mockResponse([
            'success' => true,
        ]);

        $response = $this->api->slack->webHook->create([
            'text' => 'Test message',
        ]);

        $this->assertEquals(200, $response->status);
        $this->assertIsArray($response->data);
    }

    public function testRefresh(): void
    {
        $this->mockResponse([
            'success' => true,
            'webhooksRefreshed' => 3,
            'channels' => ['#general', '#alerts', '#orders'],
        ]);

        $response = $this->api->slack->webHook->refresh();

        $this->assertTrue($response->data['success']);
        $this->assertEquals(3, $response->data['webhooksRefreshed']);
        $this->assertCount(3, $response->data['channels']);
        $this->assertRequestPath('/web-hook/refresh');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testRefreshWithParams(): void
    {
        $this->mockResponse([
            'success' => true,
            'webhooksRefreshed' => 1,
            'channels' => ['#general'],
        ]);

        $response = $this->api->slack->webHook->refresh([
            'channel' => '#general',
        ]);

        $this->assertTrue($response->data['success']);
        $this->assertEquals(1, $response->data['webhooksRefreshed']);
    }

    public function testRefreshReturnsBaseResponse(): void
    {
        $this->mockResponse([
            'success' => true,
            'webhooksRefreshed' => 0,
        ]);

        $response = $this->api->slack->webHook->refresh();

        $this->assertEquals(200, $response->status);
        $this->assertIsArray($response->data);
    }
}
