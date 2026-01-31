<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Pricing\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class TaxEngineResourceTest extends AugurApiTestCase
{
    public function testCalculate(): void
    {
        $this->mockResponse([
            'subtotal' => 1000.00,
            'taxAmount' => 80.00,
            'total' => 1080.00,
            'taxRate' => 8.0,
            'taxJurisdiction' => 'CA',
            'breakdown' => [
                ['type' => 'State', 'rate' => 6.0, 'amount' => 60.00],
                ['type' => 'County', 'rate' => 1.0, 'amount' => 10.00],
                ['type' => 'City', 'rate' => 1.0, 'amount' => 10.00],
            ],
        ]);

        $response = $this->api->pricing->taxEngine->calculate([
            'subtotal' => 1000.00,
            'shipToZip' => '90210',
            'shipToState' => 'CA',
        ]);

        $this->assertEquals(80.00, $response->data['taxAmount']);
        $this->assertEquals(8.0, $response->data['taxRate']);
        $this->assertCount(3, $response->data['breakdown']);
        $this->assertRequestPath('/tax-engine');
        $this->assertRequestMethod('POST');
        $this->assertHasAuthHeader();
    }

    public function testCalculateWithExemption(): void
    {
        $this->mockResponse([
            'subtotal' => 1000.00,
            'taxAmount' => 0.00,
            'total' => 1000.00,
            'taxExempt' => true,
            'exemptReason' => 'Resale Certificate',
        ]);

        $response = $this->api->pricing->taxEngine->calculate([
            'subtotal' => 1000.00,
            'customerId' => 'TAXEXEMPT001',
            'shipToZip' => '90210',
        ]);

        $this->assertEquals(0.00, $response->data['taxAmount']);
        $this->assertTrue($response->data['taxExempt']);
        $this->assertEquals('Resale Certificate', $response->data['exemptReason']);
    }

    public function testCalculateWithLineItems(): void
    {
        $this->mockResponse([
            'subtotal' => 500.00,
            'taxAmount' => 35.00,
            'total' => 535.00,
            'lines' => [
                ['lineNo' => 1, 'amount' => 300.00, 'taxAmount' => 21.00, 'taxable' => true],
                ['lineNo' => 2, 'amount' => 200.00, 'taxAmount' => 14.00, 'taxable' => true],
            ],
        ]);

        $response = $this->api->pricing->taxEngine->calculate([
            'lines' => [
                ['lineNo' => 1, 'itemId' => 'ITEM001', 'amount' => 300.00],
                ['lineNo' => 2, 'itemId' => 'ITEM002', 'amount' => 200.00],
            ],
            'shipToZip' => '75001',
            'shipToState' => 'TX',
        ]);

        $this->assertEquals(35.00, $response->data['taxAmount']);
        $this->assertCount(2, $response->data['lines']);
    }

    public function testCalculateWithPartialExemption(): void
    {
        $this->mockResponse([
            'subtotal' => 500.00,
            'taxAmount' => 21.00,
            'total' => 521.00,
            'lines' => [
                ['lineNo' => 1, 'amount' => 300.00, 'taxAmount' => 21.00, 'taxable' => true],
                ['lineNo' => 2, 'amount' => 200.00, 'taxAmount' => 0.00, 'taxable' => false, 'exemptReason' => 'Food'],
            ],
        ]);

        $response = $this->api->pricing->taxEngine->calculate([
            'lines' => [
                ['lineNo' => 1, 'itemId' => 'HARDWARE001', 'amount' => 300.00],
                ['lineNo' => 2, 'itemId' => 'FOOD001', 'amount' => 200.00],
            ],
            'shipToZip' => '10001',
            'shipToState' => 'NY',
        ]);

        $this->assertEquals(21.00, $response->data['taxAmount']);
        $this->assertFalse($response->data['lines'][1]['taxable']);
    }

    public function testCalculateWithShipping(): void
    {
        $this->mockResponse([
            'subtotal' => 100.00,
            'shippingAmount' => 15.00,
            'taxableShipping' => true,
            'shippingTax' => 1.20,
            'productTax' => 8.00,
            'taxAmount' => 9.20,
            'total' => 124.20,
        ]);

        $response = $this->api->pricing->taxEngine->calculate([
            'subtotal' => 100.00,
            'shippingAmount' => 15.00,
            'shipToZip' => '12345',
            'shipToState' => 'PA',
        ]);

        $this->assertTrue($response->data['taxableShipping']);
        $this->assertEquals(1.20, $response->data['shippingTax']);
    }

    public function testCalculateNoTax(): void
    {
        $this->mockResponse([
            'subtotal' => 500.00,
            'taxAmount' => 0.00,
            'total' => 500.00,
            'taxRate' => 0.0,
            'taxJurisdiction' => 'OR',
            'noSalesTax' => true,
        ]);

        $response = $this->api->pricing->taxEngine->calculate([
            'subtotal' => 500.00,
            'shipToZip' => '97201',
            'shipToState' => 'OR',
        ]);

        $this->assertEquals(0.00, $response->data['taxAmount']);
        $this->assertTrue($response->data['noSalesTax']);
    }
}
