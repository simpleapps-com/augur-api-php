<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInt\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ClientsResource.
 */
final class ClientsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['clientsUid' => 1, 'clientId' => 'test-client-id', 'statusCd' => 704],
        ]);

        $response = $this->api->agrInt->clients->list(['usersUid' => 7]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/clients');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse(['clientsUid' => 1, 'credential' => 'test-credential']);

        $response = $this->api->agrInt->clients->create([
            'usersUid' => 7,
            'clientName' => 'test-client',
        ]);

        $this->assertEquals('test-credential', $response->data['credential']);
        $this->assertRequestPath('/clients');
        $this->assertRequestMethod('POST');
    }

    public function testCreateValidate(): void
    {
        $this->mockResponse(['valid' => false]);

        $response = $this->api->agrInt->clients->createValidate(['credential' => 'test-credential']);

        $this->assertFalse($response->data['valid']);
        $this->assertRequestPath('/clients/validate');
        $this->assertRequestMethod('POST');
    }

    public function testGet(): void
    {
        $this->mockResponse(['clientsUid' => 1]);

        $response = $this->api->agrInt->clients->get(1);

        $this->assertEquals(1, $response->data['clientsUid']);
        $this->assertRequestPath('/clients/1');
        $this->assertRequestMethod('GET');
    }

    public function testUpdate(): void
    {
        $this->mockResponse(['clientsUid' => 1, 'statusCd' => 700]);

        $response = $this->api->agrInt->clients->update(1, ['statusCd' => 700]);

        $this->assertEquals(700, $response->data['statusCd']);
        $this->assertRequestPath('/clients/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['clientsUid' => 1, 'statusCd' => 700]);

        $response = $this->api->agrInt->clients->delete(1);

        $this->assertEquals(700, $response->data['statusCd']);
        $this->assertRequestPath('/clients/1');
        $this->assertRequestMethod('DELETE');
    }
}
