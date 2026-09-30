<?php

declare(strict_types=1);

namespace AugurApi\Tests\Core;

use AugurApi\Core\BaseResponse;
use PHPUnit\Framework\TestCase;

final class BaseResponseTest extends TestCase
{
    public function testConstructorSetsProperties(): void
    {
        $response = new BaseResponse(
            data: ['foo' => 'bar'],
            status: 200,
            message: 'Success',
            total: 10,
            limit: 5,
            offset: 0,
        );

        $this->assertEquals(['foo' => 'bar'], $response->data);
        $this->assertEquals(200, $response->status);
        $this->assertEquals('Success', $response->message);
        $this->assertEquals(10, $response->total);
        $this->assertEquals(5, $response->limit);
        $this->assertEquals(0, $response->offset);
    }

    public function testFromArrayMapsData(): void
    {
        $rawResponse = [
            'data' => ['id' => 1, 'name' => 'Test'],
            'status' => 201,
            'message' => 'Created',
            'total' => 1,
            'limit' => 10,
            'offset' => 0,
        ];

        $response = BaseResponse::fromArray(
            $rawResponse,
            static fn ($data) => (object) $data,
        );

        $this->assertEquals(1, $response->data->id);
        $this->assertEquals('Test', $response->data->name);
        $this->assertEquals(201, $response->status);
        $this->assertEquals('Created', $response->message);
    }

    public function testFromArrayWithDefaults(): void
    {
        $rawResponse = [
            'data' => 'pong',
        ];

        $response = BaseResponse::fromArray(
            $rawResponse,
            static fn ($data) => $data,
        );

        $this->assertEquals('pong', $response->data);
        $this->assertEquals(200, $response->status);
        $this->assertNull($response->message);
        $this->assertNull($response->total);
    }

    public function testFromArrayConvertsNumericStrings(): void
    {
        $response = BaseResponse::fromArray(
            ['data' => [], 'status' => '201', 'total' => '42', 'limit' => 10.0, 'offset' => '0'],
            static fn ($data) => $data,
        );

        $this->assertSame(201, $response->status);
        $this->assertSame(42, $response->total);
        $this->assertSame(10, $response->limit);
        $this->assertSame(0, $response->offset);
    }

    public function testFromArrayIgnoresMalformedEnvelopeFields(): void
    {
        $response = BaseResponse::fromArray(
            ['data' => null, 'status' => 'ok', 'message' => ['x'], 'total' => 'many', 'limit' => true],
            static fn ($data) => $data,
        );

        $this->assertSame(200, $response->status);
        $this->assertNull($response->message);
        $this->assertNull($response->total);
        $this->assertNull($response->limit);
        $this->assertNull($response->offset);
    }
}
