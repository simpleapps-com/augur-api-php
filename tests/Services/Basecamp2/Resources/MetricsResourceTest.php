<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Basecamp2\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for MetricsResource.
 */
final class MetricsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'metric_type' => 'completion_rate', 'value' => 85.5],
            ['id' => 2, 'metric_type' => 'average_time', 'value' => 24.0],
        ]);

        $response = $this->api->basecamp2->metrics->list();

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('completion_rate', $data[0]['metric_type']);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(85.5, $data[0]['value']);
        $this->assertRequestPath('/metrics');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'metric_type' => 'completion_rate', 'value' => 85.5],
        ]);

        $response = $this->api->basecamp2->metrics->list([
            'limit' => 10,
            'offset' => 0,
            'orderBy' => 'metric_type',
        ]);

        $this->assertCount(1, $response->data);
    }

    public function testListEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->basecamp2->metrics->list();

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }
}
