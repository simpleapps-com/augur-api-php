<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\OpenSearch\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for QueryStringRedirectResource.
 */
final class QueryStringRedirectResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['queryStringRedirectUid' => 1, 'queryStringRedirectLink' => '/landing-1'],
            ['queryStringRedirectUid' => 2, 'queryStringRedirectLink' => '/landing-2'],
        ]);

        $response = $this->api->openSearch->queryStringRedirect->list();

        $this->assertCount(2, $response->data);
        $this->assertRequestPath('/query-string-redirect');
        $this->assertRequestMethod('GET');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['queryStringRedirectUid' => 1],
        ]);

        $response = $this->api->openSearch->queryStringRedirect->list(['limit' => 10]);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'queryStringRedirectUid' => 1,
            'queryStringRedirectLink' => '/landing-1',
        ]);

        $response = $this->api->openSearch->queryStringRedirect->get(1);

        $this->assertEquals(1, $response->data['queryStringRedirectUid']);
        $this->assertRequestPath('/query-string-redirect/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'queryStringRedirectUid' => 3,
            'queryStringRedirectLink' => '/landing-new',
        ], 201);

        $response = $this->api->openSearch->queryStringRedirect->create([
            'queryStringRedirectLink' => '/landing-new',
        ]);

        $this->assertEquals(3, $response->data['queryStringRedirectUid']);
        $this->assertRequestPath('/query-string-redirect');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'queryStringRedirectUid' => 1,
            'queryStringRedirectLink' => '/landing-updated',
        ]);

        $response = $this->api->openSearch->queryStringRedirect->update(
            1,
            ['queryStringRedirectLink' => '/landing-updated'],
        );

        $this->assertEquals('/landing-updated', $response->data['queryStringRedirectLink']);
        $this->assertRequestPath('/query-string-redirect/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['deleted' => true]);

        $response = $this->api->openSearch->queryStringRedirect->delete(1);

        $this->assertTrue($response->data['deleted']);
        $this->assertRequestPath('/query-string-redirect/1');
        $this->assertRequestMethod('DELETE');
    }
}
