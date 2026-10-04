<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Apis\Resources;

use AugurApi\Services\P21Apis\Resources\TransCompanyResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for TransCompanyResource.
 */
#[CoversClass(TransCompanyResource::class)]
final class TransCompanyResourceTest extends AugurApiTestCase
{
    public function testGet(): void
    {
        $this->mockResponse([
            'companyUid' => 1,
            'companyName' => 'Test Company',
            'active' => true,
        ]);

        $response = $this->api->p21Apis->transCompany->get(1);

        $this->assertEquals(1, self::at($response->data, 'companyUid'));
        $this->assertEquals('Test Company', self::at($response->data, 'companyName'));
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/trans-company/1');
    }

    public function testGetWithParams(): void
    {
        $this->mockResponse([
            'companyUid' => 1,
            'companyName' => 'Test Company',
        ]);

        $response = $this->api->p21Apis->transCompany->get(1, ['includeDetails' => true]);

        $this->assertEquals(1, self::at($response->data, 'companyUid'));
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
