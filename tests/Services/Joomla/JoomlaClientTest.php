<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Joomla;

use AugurApi\Services\Joomla\JoomlaClient;
use AugurApi\Services\Joomla\Resources\ContentResource;
use AugurApi\Services\Joomla\Resources\MenuResource;
use AugurApi\Services\Joomla\Resources\TagsResource;
use AugurApi\Services\Joomla\Resources\UsergroupsResource;
use AugurApi\Services\Joomla\Resources\UsersResource;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for JoomlaClient.
 */
final class JoomlaClientTest extends AugurApiTestCase
{
    public function testJoomlaClientAccess(): void
    {
        $this->assertInstanceOf(JoomlaClient::class, $this->api->joomla);
    }

    public function testContentResourceAccess(): void
    {
        $this->assertInstanceOf(ContentResource::class, $this->api->joomla->content);
    }

    public function testMenuResourceAccess(): void
    {
        $this->assertInstanceOf(MenuResource::class, $this->api->joomla->menu);
    }

    public function testTagsResourceAccess(): void
    {
        $this->assertInstanceOf(TagsResource::class, $this->api->joomla->tags);
    }

    public function testUsergroupsResourceAccess(): void
    {
        $this->assertInstanceOf(UsergroupsResource::class, $this->api->joomla->usergroups);
    }

    public function testUsersResourceAccess(): void
    {
        $this->assertInstanceOf(UsersResource::class, $this->api->joomla->users);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->joomla->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->joomla->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->joomla->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }
}
