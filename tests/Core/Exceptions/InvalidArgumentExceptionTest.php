<?php

declare(strict_types=1);

namespace AugurApi\Tests\Core\Exceptions;

use AugurApi\Core\Exceptions\AugurApiException;
use AugurApi\Core\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class InvalidArgumentExceptionTest extends TestCase
{
    public function testInvalidArgumentExceptionWithMessage(): void
    {
        $exception = new InvalidArgumentException('Invalid path parameter');

        $this->assertEquals('Invalid path parameter', $exception->getMessage());
        $this->assertEquals(400, $exception->getCode());
    }

    public function testInvalidArgumentExceptionExtendsAugurApiException(): void
    {
        $exception = new InvalidArgumentException('Test');

        $this->assertInstanceOf(AugurApiException::class, $exception);
    }

    public function testInvalidArgumentExceptionIsFinal(): void
    {
        $reflection = new \ReflectionClass(InvalidArgumentException::class);

        $this->assertTrue($reflection->isFinal());
    }

    public function testInvalidArgumentExceptionCanBeCaughtAsAugurApiException(): void
    {
        $caught = false;
        try {
            throw new InvalidArgumentException('Bad value');
        } catch (AugurApiException $e) {
            $caught = true;
            $this->assertInstanceOf(InvalidArgumentException::class, $e);
        }

        $this->assertTrue($caught, 'Exception was not caught');
    }

    public function testInvalidArgumentExceptionDistinctFromGlobalInvalidArgumentException(): void
    {
        $exception = new InvalidArgumentException('Test');

        $this->assertNotInstanceOf(\InvalidArgumentException::class, $exception);
    }
}
