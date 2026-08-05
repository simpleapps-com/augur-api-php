<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Schemas;

use AugurApi\Core\Schemas\EdgeCache;
use AugurApi\Services\Items\Schemas\BrandsListParams;
use AugurApi\Services\Items\Schemas\InvMast;
use AugurApi\Services\Items\Schemas\InvMastListParams;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the hand-written Items DTOs and param objects.
 *
 * These are public API — the wiki PHP-Client page documents constructing
 * BrandsListParams directly — so they are covered independently of the
 * generated resource surface.
 */
#[CoversClass(BrandsListParams::class)]
#[CoversClass(InvMastListParams::class)]
#[CoversClass(InvMast::class)]
final class ItemsSchemasTest extends TestCase
{
    public function testBrandsListParamsToArrayDropsNulls(): void
    {
        $params = new BrandsListParams(limit: 10, orderBy: 'brandName');

        $this->assertEquals(['limit' => 10, 'orderBy' => 'brandName'], $params->toArray());
    }

    public function testBrandsListParamsSerializesEdgeCacheAsWireValue(): void
    {
        $params = new BrandsListParams(q: 'acme', edgeCache: EdgeCache::FiveMinutes);

        $this->assertEquals(['q' => 'acme', 'edgeCache' => '5m'], $params->toArray());
    }

    public function testBrandsListParamsEmptyByDefault(): void
    {
        $this->assertEquals([], (new BrandsListParams())->toArray());
    }

    public function testInvMastListParamsToArray(): void
    {
        $params = new InvMastListParams(
            limit: 25,
            offset: 50,
            orderBy: 'itemId',
            q: 'widget',
            itemCategoryUid: 7,
            onlineCd: 1,
            prefix: 'WID',
            statusCd: 701,
            edgeCache: EdgeCache::OneHour,
        );

        $this->assertEquals([
            'limit' => 25,
            'offset' => 50,
            'orderBy' => 'itemId',
            'q' => 'widget',
            'itemCategoryUid' => 7,
            'onlineCd' => 1,
            'prefix' => 'WID',
            'statusCd' => 701,
            'edgeCache' => '1h',
        ], $params->toArray());
    }

    public function testInvMastListParamsEmptyByDefault(): void
    {
        $this->assertEquals([], (new InvMastListParams())->toArray());
    }

    public function testInvMastFromArrayCastsScalars(): void
    {
        $item = InvMast::fromArray([
            'invMastUid' => '123',
            'itemId' => 'WIDGET-1',
            'itemDesc' => 'A widget',
            'itemCategoryUid' => '7',
            'weight' => '2.5',
            'onlineCd' => '1',
            'statusCd' => '701',
        ]);

        $this->assertSame(123, $item->invMastUid);
        $this->assertSame(7, $item->itemCategoryUid);
        $this->assertSame(2.5, $item->weight);
        $this->assertSame(1, $item->onlineCd);
        $this->assertSame(701, $item->statusCd);
        $this->assertSame('WIDGET-1', $item->itemId);
    }

    public function testInvMastFromArrayCapturesUnknownFieldsAsExtra(): void
    {
        $item = InvMast::fromArray([
            'invMastUid' => 1,
            'itemId' => 'WIDGET-1',
            'customField' => 'kept',
            'anotherOne' => 42,
        ]);

        $this->assertEquals(['customField' => 'kept', 'anotherOne' => 42], $item->extra);
    }

    public function testInvMastFromArrayDefaultsMissingFieldsToNull(): void
    {
        $item = InvMast::fromArray([]);

        $this->assertNull($item->invMastUid);
        $this->assertNull($item->itemId);
        $this->assertNull($item->weight);
        $this->assertEquals([], $item->extra);
    }

    public function testInvMastToArraySpreadsExtraAlongsideKnownFields(): void
    {
        $item = InvMast::fromArray([
            'invMastUid' => 1,
            'itemId' => 'WIDGET-1',
            'customField' => 'kept',
        ]);

        $array = $item->toArray();

        $this->assertSame(1, $array['invMastUid']);
        $this->assertSame('WIDGET-1', $array['itemId']);
        $this->assertSame('kept', $array['customField']);
        $this->assertNull($array['itemDesc']);
    }

    public function testInvMastRoundTripsThroughFromArrayAndToArray(): void
    {
        $original = [
            'invMastUid' => 1,
            'itemId' => 'WIDGET-1',
            'itemDesc' => 'A widget',
            'extendedDesc' => 'Long description',
            'itemCategoryUid' => 7,
            'supplierPartNo' => 'SUP-1',
            'weight' => 2.5,
            'defaultSellUom' => 'EA',
            'onlineCd' => 1,
            'statusCd' => 701,
        ];

        $this->assertEquals($original, InvMast::fromArray($original)->toArray());
    }
}
