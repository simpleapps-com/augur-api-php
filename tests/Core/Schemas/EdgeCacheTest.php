<?php

declare(strict_types=1);

namespace AugurApi\Tests\Core\Schemas;

use AugurApi\Core\Schemas\EdgeCache;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the EdgeCache enum.
 *
 * The backing values are the literal wire format the API expects, so they are
 * asserted explicitly — renaming a case is safe, changing its value is not.
 */
#[CoversClass(EdgeCache::class)]
final class EdgeCacheTest extends TestCase
{
    public function testWireValues(): void
    {
        $this->assertSame('30s', EdgeCache::ThirtySeconds->value);
        $this->assertSame('1m', EdgeCache::OneMinute->value);
        $this->assertSame('5m', EdgeCache::FiveMinutes->value);
        $this->assertSame('1h', EdgeCache::OneHour->value);
        $this->assertSame('2h', EdgeCache::TwoHours->value);
        $this->assertSame('3h', EdgeCache::ThreeHours->value);
        $this->assertSame('4h', EdgeCache::FourHours->value);
        $this->assertSame('5h', EdgeCache::FiveHours->value);
        $this->assertSame('8h', EdgeCache::EightHours->value);
    }

    public function testFromWireValue(): void
    {
        $this->assertSame(EdgeCache::FiveMinutes, EdgeCache::from('5m'));
        $this->assertSame(EdgeCache::EightHours, EdgeCache::from('8h'));
    }

    public function testTryFromRejectsUnsupportedDuration(): void
    {
        // 6h and 7h are deliberately absent — Cloudflare does not accept them.
        $this->assertNull(EdgeCache::tryFrom('6h'));
        $this->assertNull(EdgeCache::tryFrom('forever'));
    }

    public function testCasesAreExhaustive(): void
    {
        $this->assertCount(9, EdgeCache::cases());
    }
}
