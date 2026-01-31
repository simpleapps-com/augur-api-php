<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Payments\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class UnifiedResourceTest extends AugurApiTestCase
{
    public function testTransactionSetup(): void
    {
        $this->mockResponse([
            'transactionSetupId' => 'TS123456',
            'redirectUrl' => 'https://pay.example.com/TS123456',
            'expiresAt' => '2024-01-15T12:00:00Z',
        ]);

        $response = $this->api->payments->unified->transactionSetup([
            'customerId' => 'CUST001',
            'amount' => 250.00,
            'returnUrl' => 'https://mysite.com/return',
        ]);

        $this->assertEquals('TS123456', $response->data['transactionSetupId']);
        $this->assertStringContainsString('https://pay.example.com', $response->data['redirectUrl']);
        $this->assertRequestPath('/unified/transaction-setup');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testTransactionSetupWithBilling(): void
    {
        $this->mockResponse([
            'transactionSetupId' => 'TS789012',
            'billingIncluded' => true,
        ]);

        $response = $this->api->payments->unified->transactionSetup([
            'customerId' => 'CUST001',
            'amount' => 500.00,
            'includeBilling' => true,
        ]);

        $this->assertTrue($response->data['billingIncluded']);
    }

    public function testValidate(): void
    {
        $this->mockResponse([
            'transactionSetupId' => 'TS123456',
            'valid' => true,
            'paymentAccountId' => 'PAY789',
            'last4' => '4242',
        ]);

        $response = $this->api->payments->unified->validate([
            'transactionSetupId' => 'TS123456',
        ]);

        $this->assertTrue($response->data['valid']);
        $this->assertEquals('PAY789', $response->data['paymentAccountId']);
        $this->assertRequestPath('/unified/validate');
        $this->assertRequestMethod('GET');
    }

    public function testValidateInvalid(): void
    {
        $this->mockResponse([
            'transactionSetupId' => 'TS999999',
            'valid' => false,
            'error' => 'Transaction setup expired',
        ]);

        $response = $this->api->payments->unified->validate([
            'transactionSetupId' => 'TS999999',
        ]);

        $this->assertFalse($response->data['valid']);
        $this->assertEquals('Transaction setup expired', $response->data['error']);
    }

    public function testAccountQuery(): void
    {
        $this->mockResponse([
            'paymentAccountId' => 'PAY789',
            'last4' => '4242',
            'cardType' => 'Visa',
            'expiryMonth' => '12',
            'expiryYear' => '2025',
            'billingAddress' => [
                'street' => '123 Test St',
                'city' => 'Test City',
                'state' => 'TS',
                'zip' => '12345',
            ],
        ]);

        $response = $this->api->payments->unified->accountQuery([
            'transactionSetupId' => 'TS123456',
        ]);

        $this->assertEquals('PAY789', $response->data['paymentAccountId']);
        $this->assertEquals('Visa', $response->data['cardType']);
        $this->assertArrayHasKey('billingAddress', $response->data);
        $this->assertRequestPath('/unified/account-query');
        $this->assertRequestMethod('GET');
    }

    public function testBillingUpdate(): void
    {
        $this->mockResponse([
            'transactionSetupId' => 'TS123456',
            'updated' => true,
            'billingAddress' => [
                'street' => '456 New St',
                'city' => 'New City',
                'state' => 'NC',
                'zip' => '67890',
            ],
        ]);

        $response = $this->api->payments->unified->billingUpdate([
            'transactionSetupId' => 'TS123456',
            'street' => '456 New St',
            'city' => 'New City',
            'state' => 'NC',
            'zip' => '67890',
        ]);

        $this->assertTrue($response->data['updated']);
        $this->assertEquals('456 New St', $response->data['billingAddress']['street']);
        $this->assertRequestPath('/unified/billing-update');
        $this->assertRequestMethod('GET');
    }

    public function testCardInfo(): void
    {
        $this->mockResponse([
            'cardType' => 'Visa',
            'last4' => '4242',
            'expiryMonth' => '12',
            'expiryYear' => '2025',
            'cardholderName' => 'John Doe',
        ]);

        $response = $this->api->payments->unified->cardInfo([
            'transactionSetupId' => 'TS123456',
        ]);

        $this->assertEquals('Visa', $response->data['cardType']);
        $this->assertEquals('4242', $response->data['last4']);
        $this->assertEquals('John Doe', $response->data['cardholderName']);
        $this->assertRequestPath('/unified/card-info');
        $this->assertRequestMethod('GET');
    }

    public function testSurcharge(): void
    {
        $this->mockResponse([
            'paymentAccountId' => 'PAY789',
            'surchargeRate' => 2.5,
            'surchargeAmount' => 6.25,
            'transactionAmount' => 250.00,
            'totalAmount' => 256.25,
        ]);

        $response = $this->api->payments->unified->surcharge([
            'paymentAccountId' => 'PAY789',
            'amount' => 250.00,
        ]);

        $this->assertEquals(2.5, $response->data['surchargeRate']);
        $this->assertEquals(6.25, $response->data['surchargeAmount']);
        $this->assertEquals(256.25, $response->data['totalAmount']);
        $this->assertRequestPath('/unified/surcharge');
        $this->assertRequestMethod('GET');
    }

    public function testSurchargeNoFee(): void
    {
        $this->mockResponse([
            'paymentAccountId' => 'PAY123',
            'surchargeRate' => 0,
            'surchargeAmount' => 0,
            'totalAmount' => 100.00,
        ]);

        $response = $this->api->payments->unified->surcharge([
            'paymentAccountId' => 'PAY123',
            'amount' => 100.00,
        ]);

        $this->assertEquals(0, $response->data['surchargeAmount']);
    }
}
