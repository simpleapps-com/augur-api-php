<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Pricing\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class TaxEngineResourceTest extends AugurApiTestCase
{
    /**
     * @return array<string, mixed>
     */
    private function lineResult(string $itemId, int $invMastUid, float $unitPrice, float $taxEstimate): array
    {
        return [
            'itemId' => $itemId,
            'invMastUid' => $invMastUid,
            'quantity' => 1.0,
            'unitOfMeasure' => 'EA',
            'unitPrice' => $unitPrice,
            'taxEstimate' => $taxEstimate,
        ];
    }

    public function testCalculate(): void
    {
        $this->mockResponse([
            'taxEstimate' => 80.00,
            'customerId' => 1001,
            'postalCode' => '90210',
            'taxRate' => 8.0,
            'items' => [$this->lineResult('ITEM001', 100, 1000.00, 80.00)],
        ]);

        $response = $this->api->pricing->taxEngine->create([
            'customerId' => 1001,
            'postalCode' => '90210',
            'items' => [['itemId' => 'ITEM001', 'quantity' => 1.0, 'unitPrice' => 1000.00]],
        ]);

        $this->assertEquals(80.00, $response->data['taxEstimate']);
        $this->assertEquals(8.0, $response->data['taxRate']);
        $this->assertCount(1, self::arrayAt($response->data, 'items'));
        $this->assertRequestPath('/tax-engine');
        $this->assertRequestMethod('POST');
        $this->assertHasAuthHeader();
    }

    public function testCalculateWithExemption(): void
    {
        $this->mockResponse([
            'taxEstimate' => 0.00,
            'customerId' => 2002,
            'postalCode' => '90210',
            'taxRate' => 0.0,
            'items' => [$this->lineResult('ITEM001', 100, 1000.00, 0.00)],
        ]);

        $response = $this->api->pricing->taxEngine->create([
            'customerId' => 2002,
            'postalCode' => '90210',
            'items' => [['itemId' => 'ITEM001', 'unitPrice' => 1000.00]],
        ]);

        $this->assertEquals(0.00, $response->data['taxEstimate']);
        $this->assertEquals(2002, $response->data['customerId']);
    }

    public function testCalculateWithLineItems(): void
    {
        $this->mockResponse([
            'taxEstimate' => 35.00,
            'customerId' => 1001,
            'postalCode' => '75001',
            'taxRate' => 7.0,
            'items' => [
                $this->lineResult('ITEM001', 100, 300.00, 21.00),
                $this->lineResult('ITEM002', 101, 200.00, 14.00),
            ],
        ]);

        $response = $this->api->pricing->taxEngine->create([
            'customerId' => 1001,
            'postalCode' => '75001',
            'items' => [
                ['itemId' => 'ITEM001', 'unitPrice' => 300.00],
                ['itemId' => 'ITEM002', 'unitPrice' => 200.00],
            ],
        ]);

        $this->assertEquals(35.00, $response->data['taxEstimate']);
        $this->assertCount(2, self::arrayAt($response->data, 'items'));
    }

    public function testCalculateWithPartialExemption(): void
    {
        $this->mockResponse([
            'taxEstimate' => 21.00,
            'customerId' => 1001,
            'postalCode' => '10001',
            'taxRate' => 7.0,
            'items' => [
                $this->lineResult('HARDWARE001', 100, 300.00, 21.00),
                $this->lineResult('FOOD001', 101, 200.00, 0.00),
            ],
        ]);

        $response = $this->api->pricing->taxEngine->create([
            'customerId' => 1001,
            'postalCode' => '10001',
            'items' => [
                ['itemId' => 'HARDWARE001', 'unitPrice' => 300.00],
                ['itemId' => 'FOOD001', 'unitPrice' => 200.00],
            ],
        ]);

        $this->assertEquals(21.00, $response->data['taxEstimate']);
        $this->assertEquals(0.00, self::at($response->data, 'items', 1, 'taxEstimate'));
    }

    public function testCalculateWithUnitOfMeasure(): void
    {
        $this->mockResponse([
            'taxEstimate' => 9.20,
            'customerId' => 1001,
            'postalCode' => '12345',
            'taxRate' => 6.0,
            'items' => [$this->lineResult('ITEM001', 100, 115.00, 9.20)],
        ]);

        $response = $this->api->pricing->taxEngine->create([
            'customerId' => 1001,
            'postalCode' => '12345',
            'items' => [
                ['itemId' => 'ITEM001', 'quantity' => 1.0, 'unitOfMeasure' => 'EA', 'unitPrice' => 115.00],
            ],
        ]);

        $this->assertEquals('EA', self::at($response->data, 'items', 0, 'unitOfMeasure'));
        $this->assertEquals(9.20, $response->data['taxEstimate']);
    }

    public function testCalculateNoTax(): void
    {
        $this->mockResponse([
            'taxEstimate' => 0.00,
            'customerId' => 1001,
            'postalCode' => '97201',
            'taxRate' => 0.0,
            'items' => [$this->lineResult('ITEM001', 100, 500.00, 0.00)],
        ]);

        $response = $this->api->pricing->taxEngine->create([
            'customerId' => 1001,
            'postalCode' => '97201',
            'items' => [['itemId' => 'ITEM001', 'unitPrice' => 500.00]],
        ]);

        $this->assertEquals(0.00, $response->data['taxEstimate']);
        $this->assertEquals(0.0, $response->data['taxRate']);
    }
}
