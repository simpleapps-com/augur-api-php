<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Joomla\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ActionLogsResource.
 */
final class ActionLogsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'extension' => 'com_users', 'userId' => 7, 'ipAddress' => '127.0.0.1'],
        ]);

        $response = $this->api->joomla->actionLogs->list(['userId' => 7, 'itemId' => 42]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/action-logs');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'extension' => 'com_users'],
        ]);

        $response = $this->api->joomla->actionLogs->get(1);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/action-logs/1');
        $this->assertRequestMethod('GET');
    }
}
