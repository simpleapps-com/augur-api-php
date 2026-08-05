<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Core\Resources;

use AugurApi\Services\P21Core\Resources\FreightCodeResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for FreightCodeResource.
 */
#[CoversClass(FreightCodeResource::class)]
final class FreightCodeResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['freightCodeUid' => 1, 'freightCd' => 'UPS', 'freightDesc' => 'UPS Ground'],
            ['freightCodeUid' => 2, 'freightCd' => 'FDX', 'freightDesc' => 'FedEx Ground'],
        ]);

        $response = $this->api->p21Core->freightCode->list();

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1, $data[0]['freightCodeUid']);
        $this->assertEquals('UPS', $data[0]['freightCd']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/freight-code');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['freightCodeUid' => 1, 'freightCd' => 'UPS'],
        ], 50);

        $response = $this->api->p21Core->freightCode->list([
            'freightCodeId' => 'UPS',
            'companyId' => '01',
            'limit' => 10,
        ]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'freightCodeUid' => 1,
            'companyId' => '01',
            'freightCd' => 'UPS',
            'freightDesc' => 'UPS Ground',
            'taxGroupId' => 'TAX1',
        ]);

        $response = $this->api->p21Core->freightCode->get(1);

        $this->assertEquals(1, $response->data['freightCodeUid']);
        $this->assertEquals('UPS', $response->data['freightCd']);
        $this->assertEquals('UPS Ground', $response->data['freightDesc']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/freight-code/1');
    }
}
