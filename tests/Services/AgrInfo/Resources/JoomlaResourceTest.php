<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInfo\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for JoomlaResource.
 */
final class JoomlaResourceTest extends AugurApiTestCase
{
    public function testGenerate(): void
    {
        $this->mockResponse(['content' => 'Joomla AI generated content']);

        $response = $this->api->agrInfo->joomla->generate([
            'prompt' => 'Test Joomla prompt',
            'model' => 'joomla-model',
        ]);

        $this->assertIsArray($response->data);
        $this->assertEquals('Joomla AI generated content', $response->data['content']);
        $this->assertRequestPath('/joomla/generate');
        $this->assertRequestMethod('POST');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGenerateWithEmptyData(): void
    {
        $this->mockResponse(['content' => 'Default Joomla response']);

        $response = $this->api->agrInfo->joomla->generate();

        $this->assertIsArray($response->data);
        $this->assertRequestMethod('POST');
    }
}
