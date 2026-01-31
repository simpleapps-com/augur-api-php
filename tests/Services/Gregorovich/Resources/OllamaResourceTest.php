<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Gregorovich\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class OllamaResourceTest extends AugurApiTestCase
{
    public function testGenerate(): void
    {
        $this->mockResponse([
            'response' => 'Generated text content here.',
            'model' => 'llama2',
            'done' => true,
        ]);

        $response = $this->api->gregorovich->ollama->generate([
            'prompt' => 'Write a product description.',
            'model' => 'llama2',
        ]);

        $this->assertEquals('Generated text content here.', $response->data['response']);
        $this->assertEquals('llama2', $response->data['model']);
        $this->assertTrue($response->data['done']);
        $this->assertRequestPath('/ollama/generate');
        $this->assertRequestMethod('POST');
        $this->assertHasAuthHeader();
    }

    public function testGenerateWithDifferentModel(): void
    {
        $this->mockResponse([
            'response' => 'Code example here.',
            'model' => 'codellama',
            'done' => true,
        ]);

        $response = $this->api->gregorovich->ollama->generate([
            'prompt' => 'Write a PHP function.',
            'model' => 'codellama',
        ]);

        $this->assertEquals('codellama', $response->data['model']);
    }

    public function testGenerateWithContext(): void
    {
        $this->mockResponse([
            'response' => 'Based on the context, the answer is yes.',
            'model' => 'llama2',
            'done' => true,
            'context' => [1, 2, 3, 4, 5],
        ]);

        $response = $this->api->gregorovich->ollama->generate([
            'prompt' => 'Continue the conversation.',
            'model' => 'llama2',
            'context' => [1, 2, 3, 4, 5],
        ]);

        $this->assertArrayHasKey('context', $response->data);
    }

    public function testGenerateWithOptions(): void
    {
        $this->mockResponse([
            'response' => 'Creative response.',
            'model' => 'llama2',
            'done' => true,
        ]);

        $response = $this->api->gregorovich->ollama->generate([
            'prompt' => 'Be creative.',
            'model' => 'llama2',
            'options' => [
                'temperature' => 0.9,
                'top_p' => 0.95,
            ],
        ]);

        $this->assertTrue($response->data['done']);
    }

    public function testGenerateStream(): void
    {
        $this->mockResponse([
            'response' => 'Partial response.',
            'model' => 'llama2',
            'done' => false,
        ]);

        $response = $this->api->gregorovich->ollama->generate([
            'prompt' => 'Generate streaming response.',
            'model' => 'llama2',
            'stream' => true,
        ]);

        $this->assertFalse($response->data['done']);
    }
}
