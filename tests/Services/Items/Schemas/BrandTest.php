<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Schemas;

use AugurApi\Services\Items\Schemas\Brand;
use PHPUnit\Framework\TestCase;

final class BrandTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = [
            'brandsUid' => 1,
            'brandName' => 'Test Brand',
            'brandDescription' => 'A test brand',
            'brandLogo' => 'logo.png',
            'brandUrl' => 'https://example.com',
            'createdAt' => '2024-01-01',
            'updatedAt' => '2024-01-02',
        ];

        $brand = Brand::fromArray($data);

        $this->assertEquals(1, $brand->brandsUid);
        $this->assertEquals('Test Brand', $brand->brandName);
        $this->assertEquals('A test brand', $brand->brandDescription);
        $this->assertEquals('logo.png', $brand->brandLogo);
        $this->assertEquals('https://example.com', $brand->brandUrl);
        $this->assertEquals('2024-01-01', $brand->createdAt);
        $this->assertEquals('2024-01-02', $brand->updatedAt);
    }

    public function testFromArrayWithExtraKeys(): void
    {
        $data = [
            'brandsUid' => 1,
            'brandName' => 'Test Brand',
            'customField' => 'custom value',
            'anotherField' => 123,
        ];

        $brand = Brand::fromArray($data);

        $this->assertEquals(1, $brand->brandsUid);
        $this->assertEquals('custom value', $brand->extra['customField']);
        $this->assertEquals(123, $brand->extra['anotherField']);
    }

    public function testFromArrayWithMissingKeys(): void
    {
        $data = ['brandsUid' => 1];

        $brand = Brand::fromArray($data);

        $this->assertEquals(1, $brand->brandsUid);
        $this->assertNull($brand->brandName);
        $this->assertNull($brand->brandDescription);
        $this->assertEmpty($brand->extra);
    }

    public function testToArray(): void
    {
        $brand = new Brand(
            brandsUid: 1,
            brandName: 'Test Brand',
            brandDescription: 'A test brand',
            brandLogo: 'logo.png',
            brandUrl: 'https://example.com',
            createdAt: '2024-01-01',
            updatedAt: '2024-01-02',
        );

        $array = $brand->toArray();

        $this->assertEquals(1, $array['brandsUid']);
        $this->assertEquals('Test Brand', $array['brandName']);
        $this->assertEquals('A test brand', $array['brandDescription']);
        $this->assertEquals('logo.png', $array['brandLogo']);
        $this->assertEquals('https://example.com', $array['brandUrl']);
        $this->assertEquals('2024-01-01', $array['createdAt']);
        $this->assertEquals('2024-01-02', $array['updatedAt']);
    }

    public function testToArrayWithExtraKeys(): void
    {
        $brand = new Brand(
            brandsUid: 1,
            brandName: 'Test Brand',
            extra: ['customField' => 'custom value'],
        );

        $array = $brand->toArray();

        $this->assertEquals(1, $array['brandsUid']);
        $this->assertEquals('custom value', $array['customField']);
    }

    public function testRoundTrip(): void
    {
        $originalData = [
            'brandsUid' => 42,
            'brandName' => 'Round Trip Brand',
            'brandDescription' => 'Testing round trip',
            'customExtra' => 'should persist',
        ];

        $brand = Brand::fromArray($originalData);
        $resultArray = $brand->toArray();

        $this->assertEquals(42, $resultArray['brandsUid']);
        $this->assertEquals('Round Trip Brand', $resultArray['brandName']);
        $this->assertEquals('Testing round trip', $resultArray['brandDescription']);
        $this->assertEquals('should persist', $resultArray['customExtra']);
    }
}
