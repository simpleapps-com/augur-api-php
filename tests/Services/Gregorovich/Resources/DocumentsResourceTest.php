<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Gregorovich\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class DocumentsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['documentUid' => 1, 'name' => 'Product Manual', 'type' => 'pdf'],
            ['documentUid' => 2, 'name' => 'FAQ Document', 'type' => 'md'],
        ]);

        $response = $this->api->gregorovich->documents->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Product Manual', $response->data[0]['name']);
        $this->assertEquals('pdf', $response->data[0]['type']);
        $this->assertRequestPath('/documents');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['documentUid' => 1, 'name' => 'Technical Doc', 'type' => 'pdf'],
        ]);

        $response = $this->api->gregorovich->documents->list([
            'type' => 'pdf',
            'limit' => 10,
        ]);

        $this->assertCount(1, $response->data);
        $this->assertEquals('pdf', $response->data[0]['type']);
    }

    public function testListEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->gregorovich->documents->list();

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }

    public function testListWithPagination(): void
    {
        $this->mockListResponse([
            ['documentUid' => 11, 'name' => 'Document 11'],
            ['documentUid' => 12, 'name' => 'Document 12'],
        ], 50);

        $response = $this->api->gregorovich->documents->list([
            'limit' => 2,
            'offset' => 10,
        ]);

        $this->assertCount(2, $response->data);
        $this->assertEquals(50, $response->total);
    }
}
