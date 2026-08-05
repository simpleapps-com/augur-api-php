<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Schemas;

use AugurApi\Core\Schemas\EdgeCache;
use AugurApi\Services\Customers\Schemas\Customer;
use AugurApi\Services\Customers\Schemas\CustomerListParams;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the hand-written Customers DTOs and param objects.
 */
#[CoversClass(CustomerListParams::class)]
#[CoversClass(Customer::class)]
final class CustomersSchemasTest extends TestCase
{
    public function testListParamsToArrayDropsNulls(): void
    {
        $params = new CustomerListParams(limit: 10, orderBy: 'customerName');

        $this->assertEquals(['limit' => 10, 'orderBy' => 'customerName'], $params->toArray());
    }

    public function testListParamsSerializesEdgeCacheAsWireValue(): void
    {
        $params = new CustomerListParams(offset: 20, q: 'acme', edgeCache: EdgeCache::ThirtySeconds);

        $this->assertEquals(
            ['offset' => 20, 'q' => 'acme', 'edgeCache' => '30s'],
            $params->toArray(),
        );
    }

    public function testListParamsEmptyByDefault(): void
    {
        $this->assertEquals([], (new CustomerListParams())->toArray());
    }

    public function testCustomerFromArrayMapsKnownFields(): void
    {
        $customer = Customer::fromArray([
            'customerId' => '1001',
            'customerName' => 'Acme Corp',
            'address1' => '1 Main St',
            'address2' => 'Suite 2',
            'city' => 'Springfield',
            'state' => 'IL',
            'postalCode' => '62701',
            'country' => 'US',
            'phone' => '555-123-4567',
            'email' => 'test@example.com',
            'statusCd' => '701',
        ]);

        $this->assertSame('1001', $customer->customerId);
        $this->assertSame('Acme Corp', $customer->customerName);
        $this->assertSame('Springfield', $customer->city);
        $this->assertSame('test@example.com', $customer->email);
        $this->assertEquals([], $customer->extra);
    }

    public function testCustomerFromArrayCapturesUnknownFieldsAsExtra(): void
    {
        $customer = Customer::fromArray([
            'customerId' => '1001',
            'creditLimit' => 50000,
            'salesrepId' => 'REP-1',
        ]);

        $this->assertEquals(['creditLimit' => 50000, 'salesrepId' => 'REP-1'], $customer->extra);
    }

    public function testCustomerFromArrayDefaultsMissingFieldsToNull(): void
    {
        $customer = Customer::fromArray([]);

        $this->assertNull($customer->customerId);
        $this->assertNull($customer->customerName);
        $this->assertNull($customer->statusCd);
        $this->assertEquals([], $customer->extra);
    }
}
