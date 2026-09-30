<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Services\Items\Resources\InternalResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for InternalResource.
 */
#[CoversClass(InternalResource::class)]
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

        $this->assertTrue(self::at($response->data, 'success'));
        $this->assertStringContainsString('pdf', self::stringAt($response->data, 'pdfUrl'));
        $this->assertEquals(12345, self::at($response->data, 'fileSize'));
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/internal/pdf');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
