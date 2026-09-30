<?php

declare(strict_types=1);

namespace AugurApi\Tests\Core;

use AugurApi\Core\Field;
use PHPUnit\Framework\TestCase;

final class FieldTest extends TestCase
{
    public function testIntConvertsNumericValues(): void
    {
        $this->assertSame(5, Field::int(5));
        $this->assertSame(5, Field::int('5'));
        $this->assertSame(5, Field::int(5.9));
    }

    public function testIntRejectsNonNumericValues(): void
    {
        $this->assertNull(Field::int(null));
        $this->assertNull(Field::int('abc'));
        $this->assertNull(Field::int(true));
        $this->assertNull(Field::int([1]));
    }
}
