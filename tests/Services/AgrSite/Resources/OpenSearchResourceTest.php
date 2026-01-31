<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrSite\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for OpenSearchResource.
 */
final class OpenSearchResourceTest extends AugurApiTestCase
{
    public function testGetEmbedding(): void
    {
        $this->mockResponse([
            'text' => 'Test input text',
            'embedding' => [0.1, 0.2, 0.3, 0.4, 0.5],
            'model' => 'text-embedding-ada-002',
        ]);

        $response = $this->api->agrSite->openSearch->getEmbedding(['text' => 'Test input text']);

        $this->assertIsArray($response->data);
        $this->assertEquals('Test input text', $response->data['text']);
        $this->assertIsArray($response->data['embedding']);
        $this->assertCount(5, $response->data['embedding']);
        $this->assertRequestPath('/open-search/embedding');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGetEmbeddingWithModel(): void
    {
        $this->mockResponse([
            'text' => 'Another test',
            'embedding' => [0.5, 0.6, 0.7],
            'model' => 'custom-model',
        ]);

        $response = $this->api->agrSite->openSearch->getEmbedding([
            'text' => 'Another test',
            'model' => 'custom-model',
        ]);

        $this->assertEquals('custom-model', $response->data['model']);
    }
}
