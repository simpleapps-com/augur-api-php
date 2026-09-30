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
     * @return array{line_1: string, line_2: string, line_3: string, city: string, region: string, postal_code: string, country_code: string}
     */
    private function address(): array
    {
        return [
            'line_1' => '100 Main St',
            'line_2' => '',
            'line_3' => '',
            'city' => 'Pittsburgh',
            'region' => 'PA',
            'postal_code' => '15222',
            'country_code' => 'US',
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
                    'item_code' => 'ITEM001',
                    'tax_code' => 'P0000000',
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
                    'item_code' => 'ITEM001',
                    'tax_code' => 'P0000000',
                ],
                [
                    'amount' => 150.00,
                    'quantity' => 3.0,
                    'item_code' => 'ITEM002',
                    'tax_code' => 'P0000000',
                    'unit_price' => 50.00,
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
