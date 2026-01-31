<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInfo\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for OllamaResource.
 */
final class OllamaResourceTest extends AugurApiTestCase
{
    public function testListTags(): void
    {
        $this->mockListResponse([
            ['name' => 'llama2', 'size' => '7B', 'modified' => '2024-01-15'],
            ['name' => 'mistral', 'size' => '7B', 'modified' => '2024-01-14'],
            ['name' => 'codellama', 'size' => '13B', 'modified' => '2024-01-13'],
        ]);

        $response = $this->api->agrInfo->ollama->listTags();

        $this->assertCount(3, $response->data);
        $this->assertEquals('llama2', $response->data[0]['name']);
        $this->assertEquals('mistral', $response->data[1]['name']);
        $this->assertRequestPath('/ollama/tags');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListTagsEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->agrInfo->ollama->listTags();

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }
}
