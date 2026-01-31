<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Payments\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class ElementResourceTest extends AugurApiTestCase
{
    public function testCreatePayment(): void
    {
        $this->mockResponse([
            'paymentAccountId' => 'PAY123456',
            'tokenizedCard' => 'tok_abc123',
            'last4' => '4242',
            'cardType' => 'Visa',
            'expiryMonth' => '12',
            'expiryYear' => '2025',
        ]);

        $response = $this->api->payments->element->createPayment([
            'cardNumber' => '4242424242424242',
            'expiryMonth' => '12',
            'expiryYear' => '2025',
            'cvv' => '123',
        ]);

        $this->assertEquals('PAY123456', $response->data['paymentAccountId']);
        $this->assertEquals('4242', $response->data['last4']);
        $this->assertEquals('Visa', $response->data['cardType']);
        $this->assertRequestPath('/element/payment');
        $this->assertRequestMethod('POST');
        $this->assertHasAuthHeader();
    }

    public function testCreatePaymentWithBillingAddress(): void
    {
        $this->mockResponse([
            'paymentAccountId' => 'PAY789012',
            'tokenizedCard' => 'tok_def456',
            'avsResponse' => 'Y',
        ]);

        $response = $this->api->payments->element->createPayment([
            'cardNumber' => '4111111111111111',
            'expiryMonth' => '06',
            'expiryYear' => '2026',
            'cvv' => '456',
            'billingAddress' => [
                'street' => '123 Test St',
                'city' => 'Test City',
                'state' => 'TS',
                'zip' => '12345',
            ],
        ]);

        $this->assertEquals('Y', $response->data['avsResponse']);
    }

    public function testCreatePaymentWithCustomerId(): void
    {
        $this->mockResponse([
            'paymentAccountId' => 'PAY345678',
            'customerId' => 'CUST001',
            'stored' => true,
        ]);

        $response = $this->api->payments->element->createPayment([
            'cardNumber' => '5555555555554444',
            'expiryMonth' => '03',
            'expiryYear' => '2027',
            'cvv' => '789',
            'customerId' => 'CUST001',
            'storeCard' => true,
        ]);

        $this->assertEquals('CUST001', $response->data['customerId']);
        $this->assertTrue($response->data['stored']);
    }

    public function testCreatePaymentMastercard(): void
    {
        $this->mockResponse([
            'paymentAccountId' => 'PAY567890',
            'cardType' => 'Mastercard',
            'last4' => '4444',
        ]);

        $response = $this->api->payments->element->createPayment([
            'cardNumber' => '5555555555554444',
            'expiryMonth' => '09',
            'expiryYear' => '2028',
            'cvv' => '321',
        ]);

        $this->assertEquals('Mastercard', $response->data['cardType']);
    }
}
