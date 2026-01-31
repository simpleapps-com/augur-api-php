<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for InternalResource.
 *
 * @covers \AugurApi\Services\Items\Resources\InternalResource
 */
final class InternalResourceTest extends AugurApiTestCase
{
    public function testCreatePdf(): void
    {
        $this->mockResponse([
            'success' => true,
            'pdfUrl' => 'https://example.com/generated.pdf',
            'fileSize' => 12345,
        ]);

        $response = $this->api->items->internal->createPdf([
            'templateId' => 'product-spec',
            'invMastUid' => 100,
            'includeImages' => true,
        ]);

        $this->assertTrue($response->data['success']);
        $this->assertStringContainsString('pdf', $response->data['pdfUrl']);
        $this->assertEquals(12345, $response->data['fileSize']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/internal/pdf');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
