<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Pim\Resources;

use AugurApi\Services\P21Pim\Resources\InvMastFilesResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for InvMastFilesResource.
 */
#[CoversClass(InvMastFilesResource::class)]
final class InvMastFilesResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['invMastFilesUid' => 1, 'invMastUid' => 100, 'fileName' => 'spec-sheet.pdf'],
            ['invMastFilesUid' => 2, 'invMastUid' => 101, 'fileName' => 'manual.pdf'],
        ]);

        $response = $this->api->p21Pim->invMastFiles->list();

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1, $data[0]['invMastFilesUid']);
        $this->assertEquals('spec-sheet.pdf', $data[0]['fileName']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast-files');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['invMastFilesUid' => 1, 'invMastUid' => 100],
        ], 50);

        $response = $this->api->p21Pim->invMastFiles->list(['invMastUid' => 100, 'limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
        $this->assertRequestPath('/inv-mast-files');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'invMastFilesUid' => 1,
            'invMastUid' => 100,
            'fileName' => 'spec-sheet.pdf',
        ]);

        $response = $this->api->p21Pim->invMastFiles->get(1);

        $this->assertEquals(1, $response->data['invMastFilesUid']);
        $this->assertEquals('spec-sheet.pdf', $response->data['fileName']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast-files/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'invMastFilesUid' => 3,
            'invMastUid' => 102,
            'fileName' => 'new-file.pdf',
        ]);

        $response = $this->api->p21Pim->invMastFiles->create([
            'invMastUid' => 102,
            'fileName' => 'new-file.pdf',
        ]);

        $this->assertEquals(3, $response->data['invMastFilesUid']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/inv-mast-files');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'invMastFilesUid' => 1,
            'fileName' => 'renamed.pdf',
        ]);

        $response = $this->api->p21Pim->invMastFiles->update(1, ['fileName' => 'renamed.pdf']);

        $this->assertEquals('renamed.pdf', $response->data['fileName']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/inv-mast-files/1');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['success' => true]);

        $response = $this->api->p21Pim->invMastFiles->delete(1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/inv-mast-files/1');
    }
}
