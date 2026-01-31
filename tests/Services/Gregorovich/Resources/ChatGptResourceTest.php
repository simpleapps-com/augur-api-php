<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Gregorovich\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class ChatGptResourceTest extends AugurApiTestCase
{
    public function testAsk(): void
    {
        $this->mockResponse([
            'answer' => 'The capital of France is Paris.',
            'model' => 'gpt-4',
            'tokens' => 25,
        ]);

        $response = $this->api->gregorovich->chatGpt->ask([
            'question' => 'What is the capital of France?',
        ]);

        $this->assertEquals('The capital of France is Paris.', $response->data['answer']);
        $this->assertEquals('gpt-4', $response->data['model']);
        $this->assertRequestPath('/chat-gpt/ask');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testAskWithContext(): void
    {
        $this->mockResponse([
            'answer' => 'Based on the document, the product price is $99.99.',
            'model' => 'gpt-4',
            'tokens' => 50,
        ]);

        $response = $this->api->gregorovich->chatGpt->ask([
            'question' => 'What is the price?',
            'context' => 'Product document context here',
        ]);

        $this->assertStringContainsString('$99.99', $response->data['answer']);
    }

    public function testAskWithModel(): void
    {
        $this->mockResponse([
            'answer' => 'Test response.',
            'model' => 'gpt-3.5-turbo',
            'tokens' => 10,
        ]);

        $response = $this->api->gregorovich->chatGpt->ask([
            'question' => 'Simple question',
            'model' => 'gpt-3.5-turbo',
        ]);

        $this->assertEquals('gpt-3.5-turbo', $response->data['model']);
    }

    public function testAskWithMaxTokens(): void
    {
        $this->mockResponse([
            'answer' => 'Short response.',
            'model' => 'gpt-4',
            'tokens' => 5,
        ]);

        $response = $this->api->gregorovich->chatGpt->ask([
            'question' => 'Give a detailed answer.',
            'maxTokens' => 100,
        ]);

        $this->assertLessThanOrEqual(100, $response->data['tokens']);
    }
}
