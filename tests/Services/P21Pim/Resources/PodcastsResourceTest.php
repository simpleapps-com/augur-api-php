<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Pim\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for PodcastsResource.
 *
 * @covers \AugurApi\Services\P21Pim\Resources\PodcastsResource
 */
final class PodcastsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['podcastsUid' => 1, 'title' => 'Product Update Episode 1', 'duration' => 1800],
            ['podcastsUid' => 2, 'title' => 'Industry Trends', 'duration' => 2400],
        ]);

        $response = $this->api->p21Pim->podcasts->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['podcastsUid']);
        $this->assertEquals('Product Update Episode 1', $response->data[0]['title']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/podcasts');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['podcastsUid' => 1, 'title' => 'Product Update Episode 1'],
        ], 100);

        $response = $this->api->p21Pim->podcasts->list(['limit' => 10, 'q' => 'product']);

        $this->assertCount(1, $response->data);
        $this->assertEquals(100, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'podcastsUid' => 1,
            'title' => 'Product Update Episode 1',
            'description' => 'Latest product updates and features',
            'duration' => 1800,
            'url' => 'https://example.com/podcasts/1.mp3',
        ]);

        $response = $this->api->p21Pim->podcasts->get(1);

        $this->assertEquals(1, $response->data['podcastsUid']);
        $this->assertEquals('Product Update Episode 1', $response->data['title']);
        $this->assertEquals(1800, $response->data['duration']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/podcasts/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'podcastsUid' => 3,
            'title' => 'New Podcast Episode',
            'description' => 'A brand new episode',
            'duration' => 3600,
        ]);

        $response = $this->api->p21Pim->podcasts->create([
            'title' => 'New Podcast Episode',
            'description' => 'A brand new episode',
            'duration' => 3600,
        ]);

        $this->assertEquals(3, $response->data['podcastsUid']);
        $this->assertEquals('New Podcast Episode', $response->data['title']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/podcasts');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'podcastsUid' => 1,
            'title' => 'Updated Podcast Title',
            'description' => 'Updated description',
        ]);

        $response = $this->api->p21Pim->podcasts->update(1, [
            'title' => 'Updated Podcast Title',
            'description' => 'Updated description',
        ]);

        $this->assertEquals('Updated Podcast Title', $response->data['title']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/podcasts/1');
    }

    public function testDelete(): void
    {
        $this->mockResponse([
            'success' => true,
        ]);

        $response = $this->api->p21Pim->podcasts->delete(1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/podcasts/1');
    }
}
