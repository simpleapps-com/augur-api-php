<?php

declare(strict_types=1);

namespace AugurApi\Tests\Core\Exceptions;

use AugurApi\Core\Exceptions\AugurApiException;
use AugurApi\Core\Exceptions\AuthenticationException;
use AugurApi\Core\Exceptions\RateLimitException;
use AugurApi\Core\Exceptions\ValidationException;
use PHPUnit\Framework\TestCase;

final class AugurApiExceptionTest extends TestCase
{
    public function testAugurApiExceptionWithMessage(): void
    {
        $exception = new AugurApiException('Test error message');

        $this->assertEquals('Test error message', $exception->getMessage());
        $this->assertEquals(0, $exception->getCode());
    }

    public function testAugurApiExceptionWithMessageAndCode(): void
    {
        $exception = new AugurApiException('Server error', 500);

        $this->assertEquals('Server error', $exception->getMessage());
        $this->assertEquals(500, $exception->getCode());
    }

    public function testAugurApiExceptionWithPreviousException(): void
    {
        $previous = new \RuntimeException('Original error');
        $exception = new AugurApiException('Wrapped error', 500, $previous);

        $this->assertEquals('Wrapped error', $exception->getMessage());
        $this->assertEquals(500, $exception->getCode());
        $this->assertSame($previous, $exception->getPrevious());
    }

    public function testAugurApiExceptionDefaultMessage(): void
    {
        $exception = new AugurApiException();

        $this->assertEquals('API request failed', $exception->getMessage());
    }

    public function testAugurApiExceptionExtendsException(): void
    {
        $exception = new AugurApiException('Test');

        $this->assertInstanceOf(\Exception::class, $exception);
    }

    public function testAuthenticationExceptionWithMessage(): void
    {
        $exception = new AuthenticationException('Invalid token');

        $this->assertEquals('Invalid token', $exception->getMessage());
        $this->assertEquals(401, $exception->getCode());
    }

    public function testAuthenticationExceptionWithCode(): void
    {
        $exception = new AuthenticationException('Access denied', 403);

        $this->assertEquals('Access denied', $exception->getMessage());
        $this->assertEquals(403, $exception->getCode());
    }

    public function testAuthenticationExceptionDefaultValues(): void
    {
        $exception = new AuthenticationException();

        $this->assertEquals('Authentication failed', $exception->getMessage());
        $this->assertEquals(401, $exception->getCode());
    }

    public function testAuthenticationExceptionExtendsAugurApiException(): void
    {
        $exception = new AuthenticationException();

        $this->assertInstanceOf(AugurApiException::class, $exception);
    }

    public function testRateLimitExceptionWithMessage(): void
    {
        $exception = new RateLimitException('Too many requests');

        $this->assertEquals('Too many requests', $exception->getMessage());
        $this->assertEquals(429, $exception->getCode());
    }

    public function testRateLimitExceptionWithCode(): void
    {
        $exception = new RateLimitException('Rate limited', 429);

        $this->assertEquals('Rate limited', $exception->getMessage());
        $this->assertEquals(429, $exception->getCode());
    }

    public function testRateLimitExceptionDefaultValues(): void
    {
        $exception = new RateLimitException();

        $this->assertEquals('Rate limit exceeded', $exception->getMessage());
        $this->assertEquals(429, $exception->getCode());
    }

    public function testRateLimitExceptionExtendsAugurApiException(): void
    {
        $exception = new RateLimitException();

        $this->assertInstanceOf(AugurApiException::class, $exception);
    }

    public function testValidationExceptionWithMessage(): void
    {
        $exception = new ValidationException('Invalid input');

        $this->assertEquals('Invalid input', $exception->getMessage());
        $this->assertEquals(400, $exception->getCode());
        $this->assertEquals([], $exception->errors);
    }

    public function testValidationExceptionWithErrors(): void
    {
        $errors = [
            'name' => 'Name is required',
            'email' => 'Invalid email format',
        ];
        $exception = new ValidationException('Validation failed', 400, $errors);

        $this->assertEquals('Validation failed', $exception->getMessage());
        $this->assertEquals(400, $exception->getCode());
        $this->assertEquals($errors, $exception->errors);
    }

    public function testValidationExceptionDefaultValues(): void
    {
        $exception = new ValidationException();

        $this->assertEquals('Validation failed', $exception->getMessage());
        $this->assertEquals(400, $exception->getCode());
        $this->assertEquals([], $exception->errors);
    }

    public function testValidationExceptionExtendsAugurApiException(): void
    {
        $exception = new ValidationException();

        $this->assertInstanceOf(AugurApiException::class, $exception);
    }

    public function testValidationExceptionErrorsIsReadonly(): void
    {
        $reflection = new \ReflectionClass(ValidationException::class);
        $property = $reflection->getProperty('errors');

        $this->assertTrue($property->isReadOnly());
    }

    public function testValidationExceptionWithNestedErrors(): void
    {
        $errors = [
            'address' => [
                'street' => 'Street is required',
                'city' => 'City is required',
            ],
            'items' => [
                0 => ['qty' => 'Quantity must be positive'],
                1 => ['sku' => 'SKU is required'],
            ],
        ];
        $exception = new ValidationException('Validation failed', 400, $errors);

        $this->assertEquals($errors, $exception->errors);
        $this->assertEquals('Street is required', $exception->errors['address']['street']);
    }

    public function testAuthenticationExceptionIsFinal(): void
    {
        $reflection = new \ReflectionClass(AuthenticationException::class);

        $this->assertTrue($reflection->isFinal());
    }

    public function testRateLimitExceptionIsFinal(): void
    {
        $reflection = new \ReflectionClass(RateLimitException::class);

        $this->assertTrue($reflection->isFinal());
    }

    public function testValidationExceptionIsFinal(): void
    {
        $reflection = new \ReflectionClass(ValidationException::class);

        $this->assertTrue($reflection->isFinal());
    }

    public function testAugurApiExceptionCanBeCaught(): void
    {
        $caught = false;
        try {
            throw new AugurApiException('Test', 500);
        } catch (AugurApiException $e) {
            $caught = true;
            $this->assertEquals('Test', $e->getMessage());
        }

        $this->assertTrue($caught, 'Exception was not caught');
    }

    public function testAuthenticationExceptionCanBeCaughtAsAugurApiException(): void
    {
        $caught = false;
        try {
            throw new AuthenticationException('Unauthorized');
        } catch (AugurApiException $e) {
            $caught = true;
            $this->assertInstanceOf(AuthenticationException::class, $e);
        }

        $this->assertTrue($caught, 'Exception was not caught');
    }

    public function testRateLimitExceptionCanBeCaughtAsAugurApiException(): void
    {
        $caught = false;
        try {
            throw new RateLimitException('Rate limited');
        } catch (AugurApiException $e) {
            $caught = true;
            $this->assertInstanceOf(RateLimitException::class, $e);
        }

        $this->assertTrue($caught, 'Exception was not caught');
    }

    public function testValidationExceptionCanBeCaughtAsAugurApiException(): void
    {
        $caught = false;
        try {
            throw new ValidationException('Invalid', 400, ['field' => 'error']);
        } catch (AugurApiException $e) {
            $caught = true;
            $this->assertInstanceOf(ValidationException::class, $e);
        }

        $this->assertTrue($caught, 'Exception was not caught');
    }
}
