<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Core\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for PaymentTypesResource.
 *
 * @covers \AugurApi\Services\P21Core\Resources\PaymentTypesResource
 */
final class PaymentTypesResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['paymentTypeId' => 1, 'paymentTypeName' => 'Cash', 'active' => true],
            ['paymentTypeId' => 2, 'paymentTypeName' => 'Credit Card', 'active' => true],
            ['paymentTypeId' => 3, 'paymentTypeName' => 'Check', 'active' => true],
        ]);

        $response = $this->api->p21Core->paymentTypes->list();

        $this->assertCount(3, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1, $data[0]['paymentTypeId']);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Cash', $data[0]['paymentTypeName']);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Credit Card', $data[1]['paymentTypeName']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/payment-types');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['paymentTypeId' => 1, 'paymentTypeName' => 'Cash'],
            ['paymentTypeId' => 2, 'paymentTypeName' => 'Credit Card'],
        ], 10);

        $response = $this->api->p21Core->paymentTypes->list(['active' => true, 'limit' => 5]);

        $this->assertCount(2, $response->data);
        $this->assertEquals(10, $response->total);
    }

    public function testListReturnsEmptyArray(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->p21Core->paymentTypes->list(['active' => false]);

        $this->assertCount(0, $response->data);
        $this->assertEquals(0, $response->total);
    }
}
