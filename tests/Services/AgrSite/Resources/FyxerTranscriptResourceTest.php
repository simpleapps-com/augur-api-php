<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrSite\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for FyxerTranscriptResource.
 */
final class FyxerTranscriptResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['fyxerTranscriptHdrUid' => 1, 'title' => 'Transcript A', 'status' => 'complete'],
            ['fyxerTranscriptHdrUid' => 2, 'title' => 'Transcript B', 'status' => 'pending'],
        ]);

        $response = $this->api->agrSite->fyxerTranscript->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Transcript A', $response->data[0]['title']);
        $this->assertRequestPath('/fyxer-transcript');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['fyxerTranscriptHdrUid' => 1, 'title' => 'Transcript A'],
        ]);

        $response = $this->api->agrSite->fyxerTranscript->list(['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'fyxerTranscriptHdrUid' => 1,
            'title' => 'Transcript A',
            'status' => 'complete',
            'content' => 'Full transcript content here',
        ]);

        $response = $this->api->agrSite->fyxerTranscript->get(1);

        $this->assertEquals(1, $response->data['fyxerTranscriptHdrUid']);
        $this->assertEquals('Transcript A', $response->data['title']);
        $this->assertRequestPath('/fyxer-transcript/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'fyxerTranscriptHdrUid' => 3,
            'title' => 'New Transcript',
            'status' => 'pending',
        ]);

        $response = $this->api->agrSite->fyxerTranscript->create([
            'title' => 'New Transcript',
            'audioUrl' => 'https://example.com/audio.mp3',
        ]);

        $this->assertEquals(3, $response->data['fyxerTranscriptHdrUid']);
        $this->assertEquals('New Transcript', $response->data['title']);
        $this->assertRequestPath('/fyxer-transcript');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'fyxerTranscriptHdrUid' => 1,
            'title' => 'Updated Transcript',
            'status' => 'complete',
        ]);

        $response = $this->api->agrSite->fyxerTranscript->update(1, ['title' => 'Updated Transcript']);

        $this->assertEquals('Updated Transcript', $response->data['title']);
        $this->assertRequestPath('/fyxer-transcript/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->agrSite->fyxerTranscript->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/fyxer-transcript/1');
        $this->assertRequestMethod('DELETE');
    }
}
