<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\OpenSearch\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class SuggestionsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['suggestionsUid' => 1, 'term' => 'hammer', 'count' => 150],
            ['suggestionsUid' => 2, 'term' => 'screwdriver', 'count' => 100],
        ]);

        $response = $this->api->openSearch->suggestions->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('hammer', $response->data[0]['term']);
        $this->assertEquals(150, $response->data[0]['count']);
        $this->assertRequestPath('/suggestions');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['suggestionsUid' => 1, 'term' => 'drill', 'count' => 200],
        ], 50);

        $response = $this->api->openSearch->suggestions->list([
            'limit' => 10,
            'orderBy' => 'count',
        ]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'suggestionsUid' => 123,
            'term' => 'power tools',
            'count' => 500,
            'relatedTerms' => ['drill', 'saw', 'grinder'],
        ]);

        $response = $this->api->openSearch->suggestions->get(123);

        $this->assertEquals(123, $response->data['suggestionsUid']);
        $this->assertEquals('power tools', $response->data['term']);
        $this->assertContains('drill', $response->data['relatedTerms']);
        $this->assertRequestPath('/suggestions/123');
        $this->assertRequestMethod('GET');
    }

    public function testSuggest(): void
    {
        $this->mockResponse([
            'suggestions' => [
                'hammer',
                'hammer drill',
                'hammock',
            ],
            'query' => 'ham',
        ]);

        $response = $this->api->openSearch->suggestions->suggest(['q' => 'ham']);

        $this->assertCount(3, $response->data['suggestions']);
        $this->assertEquals('hammer', $response->data['suggestions'][0]);
        $this->assertRequestPath('/suggestions/suggest');
        $this->assertRequestMethod('GET');
    }

    public function testSuggestWithLimit(): void
    {
        $this->mockResponse([
            'suggestions' => ['drill', 'drill bit'],
            'query' => 'dri',
            'limit' => 2,
        ]);

        $response = $this->api->openSearch->suggestions->suggest([
            'q' => 'dri',
            'limit' => 2,
        ]);

        $this->assertCount(2, $response->data['suggestions']);
    }

    public function testSuggestEmpty(): void
    {
        $this->mockResponse([
            'suggestions' => [],
            'query' => 'xyz123',
        ]);

        $response = $this->api->openSearch->suggestions->suggest(['q' => 'xyz123']);

        $this->assertEmpty($response->data['suggestions']);
    }

    public function testSuggestWithCategory(): void
    {
        $this->mockResponse([
            'suggestions' => ['lawn mower', 'lawn edger'],
            'query' => 'lawn',
            'category' => 'Outdoor',
        ]);

        $response = $this->api->openSearch->suggestions->suggest([
            'q' => 'lawn',
            'category' => 'Outdoor',
        ]);

        $this->assertCount(2, $response->data['suggestions']);
        $this->assertEquals('Outdoor', $response->data['category']);
    }

    public function testListEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->openSearch->suggestions->list();

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }
}
