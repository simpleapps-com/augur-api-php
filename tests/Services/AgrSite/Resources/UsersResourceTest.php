<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrSite\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for AgrSite UsersResource.
 */
final class UsersResourceTest extends AugurApiTestCase
{
    public function testListAddresses(): void
    {
        $this->mockListResponse([
            ['userAddressUid' => 1, 'city' => 'Portland'],
            ['userAddressUid' => 2, 'city' => 'Seattle'],
        ]);

        $response = $this->api->agrSite->users->listAddresses(7);

        $this->assertCount(2, $response->data);
        $this->assertRequestPath('/users/7/addresses');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListAddressesWithParams(): void
    {
        $this->mockListResponse([
            ['userAddressUid' => 1],
        ]);

        $response = $this->api->agrSite->users->listAddresses(7, ['limit' => 1]);

        $this->assertCount(1, $response->data);
        $this->assertStringContainsString('limit=1', $this->getLastRequest()->getUri()->getQuery());
    }

    public function testCreateAddresses(): void
    {
        $this->mockResponse([
            'userAddressUid' => 3,
            'city' => 'Boise',
        ]);

        $response = $this->api->agrSite->users->createAddresses(7, [
            'city' => 'Boise',
        ]);

        $this->assertEquals(3, $response->data['userAddressUid']);
        $this->assertRequestPath('/users/7/addresses');
        $this->assertRequestMethod('POST');
    }

    public function testGetAddresses(): void
    {
        $this->mockResponse([
            'userAddressUid' => 2,
            'city' => 'Seattle',
        ]);

        $response = $this->api->agrSite->users->getAddresses(7, 2);

        $this->assertEquals('Seattle', $response->data['city']);
        $this->assertRequestPath('/users/7/addresses/2');
        $this->assertRequestMethod('GET');
    }

    public function testUpdateAddresses(): void
    {
        $this->mockResponse([
            'userAddressUid' => 2,
            'city' => 'Tacoma',
        ]);

        $response = $this->api->agrSite->users->updateAddresses(7, 2, [
            'city' => 'Tacoma',
        ]);

        $this->assertEquals('Tacoma', $response->data['city']);
        $this->assertRequestPath('/users/7/addresses/2');
        $this->assertRequestMethod('PUT');
    }

    public function testDeleteAddresses(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->agrSite->users->deleteAddresses(7, 2);

        $this->assertTrue($response->data['success']);
        $this->assertRequestPath('/users/7/addresses/2');
        $this->assertRequestMethod('DELETE');
    }
}
