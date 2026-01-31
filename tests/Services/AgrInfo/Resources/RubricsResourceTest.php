<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInfo\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for RubricsResource.
 */
final class RubricsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['rubricsUid' => 1, 'name' => 'Rubric A', 'category' => 'general'],
            ['rubricsUid' => 2, 'name' => 'Rubric B', 'category' => 'technical'],
        ]);

        $response = $this->api->agrInfo->rubrics->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Rubric A', $response->data[0]['name']);
        $this->assertRequestPath('/rubrics');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['rubricsUid' => 1, 'name' => 'Rubric A'],
        ]);

        $response = $this->api->agrInfo->rubrics->list(['limit' => 10, 'orderBy' => 'name']);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'rubricsUid' => 1,
            'name' => 'Rubric A',
            'category' => 'general',
            'description' => 'A general purpose rubric',
        ]);

        $response = $this->api->agrInfo->rubrics->get(1);

        $this->assertEquals(1, $response->data['rubricsUid']);
        $this->assertEquals('Rubric A', $response->data['name']);
        $this->assertRequestPath('/rubrics/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'rubricsUid' => 3,
            'name' => 'New Rubric',
            'category' => 'custom',
        ]);

        $response = $this->api->agrInfo->rubrics->create([
            'name' => 'New Rubric',
            'category' => 'custom',
            'description' => 'A custom rubric',
        ]);

        $this->assertEquals(3, $response->data['rubricsUid']);
        $this->assertEquals('New Rubric', $response->data['name']);
        $this->assertRequestPath('/rubrics');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'rubricsUid' => 1,
            'name' => 'Updated Rubric',
            'category' => 'general',
        ]);

        $response = $this->api->agrInfo->rubrics->update(1, ['name' => 'Updated Rubric']);

        $this->assertEquals('Updated Rubric', $response->data['name']);
        $this->assertRequestPath('/rubrics/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->agrInfo->rubrics->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/rubrics/1');
        $this->assertRequestMethod('DELETE');
    }
}
