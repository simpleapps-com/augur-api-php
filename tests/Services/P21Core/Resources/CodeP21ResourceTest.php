<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Core\Resources;

use AugurApi\Services\P21Core\Resources\CodeP21Resource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for CodeP21Resource.
 */
#[CoversClass(CodeP21Resource::class)]
final class CodeP21ResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['codeId' => 'STAT', 'codeValue' => 'A', 'description' => 'Active'],
            ['codeId' => 'STAT', 'codeValue' => 'I', 'description' => 'Inactive'],
        ]);

        $response = $this->api->p21Core->codeP21->list();

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('STAT', $data[0]['codeId']);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('A', $data[0]['codeValue']);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Active', $data[0]['description']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/code-p21');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['codeId' => 'TYPE', 'codeValue' => 'C', 'description' => 'Customer'],
            ['codeId' => 'TYPE', 'codeValue' => 'V', 'description' => 'Vendor'],
        ], 100);

        $response = $this->api->p21Core->codeP21->list(['codeId' => 'TYPE', 'limit' => 50]);

        $this->assertCount(2, $response->data);
        $this->assertEquals(100, $response->total);
    }

    public function testListWithFilterByCodeId(): void
    {
        $this->mockListResponse([
            ['codeId' => 'PRIORITY', 'codeValue' => 'H', 'description' => 'High'],
            ['codeId' => 'PRIORITY', 'codeValue' => 'M', 'description' => 'Medium'],
            ['codeId' => 'PRIORITY', 'codeValue' => 'L', 'description' => 'Low'],
        ]);

        $response = $this->api->p21Core->codeP21->list(['codeId' => 'PRIORITY']);

        $this->assertCount(3, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('High', $data[0]['description']);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'codeUid' => 9,
            'codeId' => 'PRIORITY',
            'description' => 'High',
        ]);

        $response = $this->api->p21Core->codeP21->get(9);

        $this->assertEquals('High', $response->data['description']);
        $this->assertRequestPath('/code-p21/9');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
