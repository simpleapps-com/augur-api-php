<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Avalara\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for Avalara RatesResource.
 */
final class RatesResourceTest extends AugurApiTestCase
{
    /**
     * @return array{line1: string, line2: string, line3: string, city: string, region: string, postalCode: string, countryCode: string}
     */
    private function address(): array
    {
        return [
            'line1' => '100 Main St',
            'line2' => '',
            'line3' => '',
            'city' => 'Pittsburgh',
            'region' => 'PA',
            'postalCode' => '15222',
            'countryCode' => 'US',
        ];
    }

    public function testCreate(): void
    {
        $this->mockResponse(10.50);

        $response = $this->api->avalara->rates->create([
            'address' => $this->address(),
            'items' => [
                [
                    'amount' => 100.00,
                    'quantity' => 1.0,
                    'itemCode' => 'ITEM001',
                    'taxCode' => 'P0000000',
                ],
            ],
        ]);

        $this->assertEquals(10.50, $response->data);
        $this->assertRequestPath('/rates');
        $this->assertRequestMethod('POST');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testCreateWithMultipleLines(): void
    {
        $this->mockResponse(25.75);

        $response = $this->api->avalara->rates->create([
            'address' => $this->address(),
            'items' => [
                [
                    'amount' => 100.00,
                    'quantity' => 1.0,
                    'itemCode' => 'ITEM001',
                    'taxCode' => 'P0000000',
                ],
                [
                    'amount' => 150.00,
                    'quantity' => 3.0,
                    'itemCode' => 'ITEM002',
                    'taxCode' => 'P0000000',
                    'unitPrice' => 50.00,
                ],
            ],
        ]);

        $this->assertEquals(25.75, $response->data);
        $body = json_decode((string) $this->getLastRequest()->getBody(), true);
        $this->assertIsArray($body);
        $this->assertCount(2, self::arrayAt($body, 'items'));
    }

    public function testCreateReturnsBaseResponse(): void
    {
        $this->mockResponse(5.25);

        $response = $this->api->avalara->rates->create([
            'address' => $this->address(),
            'items' => [],
        ]);

        $this->assertEquals(200, $response->status);
        $this->assertIsFloat($response->data);
    }
}
