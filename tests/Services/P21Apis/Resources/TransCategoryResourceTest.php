<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Apis\Resources;

use AugurApi\Services\P21Apis\Resources\TransCategoryResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for TransCategoryResource.
 */
#[CoversClass(TransCategoryResource::class)]
final class TransCategoryResourceTest extends AugurApiTestCase
{
    public function testCreate(): void
    {
        $this->mockResponse([
            'categoryUid' => 1,
            'categoryName' => 'Electronics',
            'description' => 'Electronic products',
        ]);

        $response = $this->api->p21Apis->transCategory->create([
            'categoryName' => 'Electronics',
            'description' => 'Electronic products',
        ]);

        $this->assertEquals(1, $response->data['categoryUid']);
        $this->assertEquals('Electronics', $response->data['categoryName']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/trans-category');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'categoryUid' => 1,
            'categoryName' => 'Electronics',
            'description' => 'Electronic products',
        ]);

        $response = $this->api->p21Apis->transCategory->get(1);

        $this->assertEquals(1, $response->data['categoryUid']);
        $this->assertEquals('Electronics', $response->data['categoryName']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/trans-category/1');
    }

    public function testGetWithParams(): void
    {
        $this->mockResponse([
            'categoryUid' => 1,
            'categoryName' => 'Electronics',
        ]);

        $response = $this->api->p21Apis->transCategory->get(1, ['includeChildren' => true]);

        $this->assertEquals(1, $response->data['categoryUid']);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'categoryUid' => 1,
            'categoryName' => 'Updated Electronics',
            'description' => 'Updated description',
        ]);

        $response = $this->api->p21Apis->transCategory->update(1, [
            'categoryName' => 'Updated Electronics',
            'description' => 'Updated description',
        ]);

        $this->assertEquals('Updated Electronics', $response->data['categoryName']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/trans-category/1');
    }

    public function testDelete(): void
    {
        $this->mockResponse([
            'success' => true,
        ]);

        $response = $this->api->p21Apis->transCategory->delete(1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/trans-category/1');
    }

    /**
     * The spec declares categoryId as a query param on PUT, so it must reach
     * the wire alongside the body rather than being folded into it.
     */
    public function testUpdateSendsQueryParams(): void
    {
        $this->mockResponse(['categoryUid' => 1]);

        $this->api->p21Apis->transCategory->update(1, ['categoryName' => 'x'], ['categoryId' => 'abc']);

        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/trans-category/1');
        $this->assertStringContainsString('categoryId=abc', $this->getLastRequest()->getUri()->getQuery());
        $this->assertStringContainsString('categoryName', (string) $this->getLastRequest()->getBody());
    }

    /**
     * DELETE declares categoryId too, and previously discarded it entirely.
     */
    public function testDeleteSendsQueryParams(): void
    {
        $this->mockResponse(['success' => true]);

        $this->api->p21Apis->transCategory->delete(1, ['categoryId' => 'abc']);

        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/trans-category/1');
        $this->assertStringContainsString('categoryId=abc', $this->getLastRequest()->getUri()->getQuery());
    }
}
