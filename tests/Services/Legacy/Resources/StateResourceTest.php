<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Legacy\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for StateResource.
 */
final class StateResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['stateUid' => 1, 'stateCode' => 'CA', 'stateName' => 'California'],
            ['stateUid' => 2, 'stateCode' => 'TX', 'stateName' => 'Texas'],
        ]);

        $response = $this->api->legacy->legacy->listState();

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('CA', $data[0]['stateCode']);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('California', $data[0]['stateName']);
        $this->assertRequestPath('/legacy/state');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['stateUid' => 1, 'stateCode' => 'CA'],
        ]);

        $response = $this->api->legacy->legacy->listState(['limit' => 10, 'countryCode' => 'US']);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/legacy/state');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'stateUid' => 1,
            'stateCode' => 'CA',
            'stateName' => 'California',
            'countryCode' => 'US',
        ]);

        $response = $this->api->legacy->legacy->getState(1);

        $this->assertEquals(1, $response->data['stateUid']);
        $this->assertEquals('CA', $response->data['stateCode']);
        $this->assertEquals('California', $response->data['stateName']);
        $this->assertRequestPath('/legacy/state/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'stateUid' => 51,
            'stateCode' => 'PR',
            'stateName' => 'Puerto Rico',
            'countryCode' => 'US',
        ], 201);

        $response = $this->api->legacy->legacy->createState([
            'stateCode' => 'PR',
            'stateName' => 'Puerto Rico',
            'countryCode' => 'US',
        ]);

        $this->assertEquals(51, $response->data['stateUid']);
        $this->assertEquals('PR', $response->data['stateCode']);
        $this->assertRequestPath('/legacy/state');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'stateUid' => 1,
            'stateCode' => 'CA',
            'stateName' => 'California State',
        ]);

        $response = $this->api->legacy->legacy->updateState(1, ['stateName' => 'California State']);

        $this->assertEquals('California State', $response->data['stateName']);
        $this->assertRequestPath('/legacy/state/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['deleted' => true]);

        $response = $this->api->legacy->legacy->deleteState(1);

        $this->assertTrue($response->data['deleted']);
        $this->assertRequestPath('/legacy/state/1');
        $this->assertRequestMethod('DELETE');
    }
}
