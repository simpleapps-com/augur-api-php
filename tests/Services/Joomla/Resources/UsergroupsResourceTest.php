<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Joomla\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for UsergroupsResource.
 */
final class UsergroupsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'title' => 'Public', 'parent_id' => 0],
            ['id' => 2, 'title' => 'Registered', 'parent_id' => 1],
            ['id' => 3, 'title' => 'Administrator', 'parent_id' => 1],
        ]);

        $response = $this->api->joomla->usergroups->list();

        $this->assertCount(3, $response->data);
        $this->assertEquals('Public', $response->data[0]['title']);
        $this->assertEquals('Registered', $response->data[1]['title']);
        $this->assertRequestPath('/usergroups');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 3, 'title' => 'Administrator'],
        ]);

        $response = $this->api->joomla->usergroups->list(['limit' => 10, 'parent_id' => 1]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/usergroups');
    }
}
