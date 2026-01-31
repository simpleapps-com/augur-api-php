<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInfo\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for AkashaResource.
 */
final class AkashaResourceTest extends AugurApiTestCase
{
    public function testGenerate(): void
    {
        $this->mockResponse(['content' => 'Generated AI response']);

        $response = $this->api->agrInfo->akasha->generate([
            'prompt' => 'Test prompt',
            'model' => 'default',
        ]);

        $this->assertIsArray($response->data);
        $this->assertEquals('Generated AI response', $response->data['content']);
        $this->assertRequestPath('/akasha/generate');
        $this->assertRequestMethod('POST');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGenerateWithEmptyData(): void
    {
        $this->mockResponse(['content' => 'Default response']);

        $response = $this->api->agrInfo->akasha->generate();

        $this->assertIsArray($response->data);
        $this->assertRequestMethod('POST');
    }
}
