<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Basecamp2;

use AugurApi\Services\Basecamp2\Resources\CommentsResource;
use AugurApi\Services\Basecamp2\Resources\EventsResource;
use AugurApi\Services\Basecamp2\Resources\MetricsResource;
use AugurApi\Services\Basecamp2\Resources\PeopleResource;
use AugurApi\Services\Basecamp2\Resources\ProjectsResource;
use AugurApi\Services\Basecamp2\Resources\TodolistsResource;
use AugurApi\Services\Basecamp2\Resources\TodosResource;
use AugurApi\Services\Basecamp2\Resources\TodosSummaryResource;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for Basecamp2Client service client.
 */
final class Basecamp2ClientTest extends AugurApiTestCase
{
    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->basecamp2->healthCheck();

        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->basecamp2->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->basecamp2->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
    }

    public function testCommentsResourceAccess(): void
    {
        $this->assertInstanceOf(CommentsResource::class, $this->api->basecamp2->comments);
    }

    public function testEventsResourceAccess(): void
    {
        $this->assertInstanceOf(EventsResource::class, $this->api->basecamp2->events);
    }

    public function testMetricsResourceAccess(): void
    {
        $this->assertInstanceOf(MetricsResource::class, $this->api->basecamp2->metrics);
    }

    public function testPeopleResourceAccess(): void
    {
        $this->assertInstanceOf(PeopleResource::class, $this->api->basecamp2->people);
    }

    public function testProjectsResourceAccess(): void
    {
        $this->assertInstanceOf(ProjectsResource::class, $this->api->basecamp2->projects);
    }

    public function testTodolistsResourceAccess(): void
    {
        $this->assertInstanceOf(TodolistsResource::class, $this->api->basecamp2->todolists);
    }

    public function testTodosResourceAccess(): void
    {
        $this->assertInstanceOf(TodosResource::class, $this->api->basecamp2->todos);
    }

    public function testTodosSummaryResourceAccess(): void
    {
        $this->assertInstanceOf(TodosSummaryResource::class, $this->api->basecamp2->todosSummary);
    }
}
