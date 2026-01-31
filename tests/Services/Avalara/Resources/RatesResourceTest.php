<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Avalara\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for Avalara RatesResource.
 */
final class RatesResourceTest extends AugurApiTestCase
{
    public function testCreate(): void
    {
        $this->mockResponse([
            'totalTax' => 10.50,
            'lines' => [
                ['lineNumber' => 1, 'tax' => 10.50],
            ],
        ]);

        $response = $this->api->avalara->rates->create([
            'lines' => [
                [
                    'number' => 1,
                    'amount' => 100.00,
                    'taxCode' => 'P0000000',
                ],
            ],
            'commit' => false,
        ]);

        $this->assertEquals(10.50, $response->data['totalTax']);
        $this->assertCount(1, $response->data['lines']);
        $this->assertRequestPath('/rates');
        $this->assertRequestMethod('POST');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testCreateWithMultipleLines(): void
    {
        $this->mockResponse([
            'totalTax' => 25.75,
            'lines' => [
                ['lineNumber' => 1, 'tax' => 10.50],
                ['lineNumber' => 2, 'tax' => 15.25],
            ],
        ]);

        $response = $this->api->avalara->rates->create([
            'lines' => [
                [
                    'number' => 1,
                    'amount' => 100.00,
                ],
                [
                    'number' => 2,
                    'amount' => 150.00,
                ],
            ],
        ]);

        $this->assertEquals(25.75, $response->data['totalTax']);
        $this->assertCount(2, $response->data['lines']);
    }

    public function testCreateReturnsBaseResponse(): void
    {
        $this->mockResponse([
            'totalTax' => 5.00,
            'lines' => [],
        ]);

        $response = $this->api->avalara->rates->create([
            'lines' => [],
        ]);

        $this->assertEquals(200, $response->status);
        $this->assertIsArray($response->data);
    }
}
