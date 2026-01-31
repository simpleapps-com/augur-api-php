<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Pim\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ItemsResource.
 *
 * @covers \AugurApi\Services\P21Pim\Resources\ItemsResource
 */
final class ItemsResourceTest extends AugurApiTestCase
{
    public function testSuggestDisplayDesc(): void
    {
        $this->mockResponse([
            'invMastUid' => 12345,
            'suggestedDisplayDesc' => 'Premium quality industrial widget with enhanced durability',
        ]);

        $response = $this->api->p21Pim->items->suggestDisplayDesc(12345);

        $this->assertEquals(12345, $response->data['invMastUid']);
        $this->assertStringContainsString('Premium', $response->data['suggestedDisplayDesc']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/items/12345/suggest-display-desc');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testSuggestDisplayDescWithParams(): void
    {
        $this->mockResponse([
            'invMastUid' => 12345,
            'suggestedDisplayDesc' => 'Industrial widget - compact and efficient',
            'confidence' => 0.95,
        ]);

        $response = $this->api->p21Pim->items->suggestDisplayDesc(12345, [
            'style' => 'concise',
            'maxLength' => 100,
        ]);

        $this->assertEquals(12345, $response->data['invMastUid']);
        $this->assertEquals(0.95, $response->data['confidence']);
    }

    public function testSuggestWebDesc(): void
    {
        $this->mockResponse([
            'invMastUid' => 12345,
            'suggestedWebDesc' => 'This premium industrial widget is designed for maximum performance in demanding environments. Features include enhanced durability, precision engineering, and superior materials that ensure long-lasting reliability.',
        ]);

        $response = $this->api->p21Pim->items->suggestWebDesc(12345);

        $this->assertEquals(12345, $response->data['invMastUid']);
        $this->assertStringContainsString('premium industrial widget', $response->data['suggestedWebDesc']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/items/12345/suggest-web-desc');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testSuggestWebDescWithParams(): void
    {
        $this->mockResponse([
            'invMastUid' => 67890,
            'suggestedWebDesc' => 'Advanced widget for professional use.',
            'wordCount' => 50,
        ]);

        $response = $this->api->p21Pim->items->suggestWebDesc(67890, [
            'tone' => 'professional',
            'includeBulletPoints' => true,
        ]);

        $this->assertEquals(67890, $response->data['invMastUid']);
        $this->assertEquals(50, $response->data['wordCount']);
    }
}
