<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Payments\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class PaytraceResourceTest extends AugurApiTestCase
{
    public function testAuthorization(): void
    {
        $this->mockResponse([
            'transactionId' => 'PT123456',
            'approvalCode' => 'APP123',
            'responseCode' => 'Approved',
            'amount' => 150.00,
        ]);

        $response = $this->api->payments->paytrace->authorization([
            'customerId' => 'CUST001',
            'amount' => 150.00,
        ]);

        $this->assertEquals('PT123456', $response->data['transactionId']);
        $this->assertEquals('Approved', $response->data['responseCode']);
        $this->assertRequestPath('/paytrace/authorization');
        $this->assertRequestMethod('POST');
        $this->assertHasAuthHeader();
    }

    public function testAuthorizationWithCard(): void
    {
        $this->mockResponse([
            'transactionId' => 'PT789012',
            'last4' => '4242',
            'cardType' => 'Visa',
        ]);

        $response = $this->api->payments->paytrace->authorization([
            'cardNumber' => '4242424242424242',
            'expMonth' => '12',
            'expYear' => '2025',
            'amount' => 200.00,
        ]);

        $this->assertEquals('4242', $response->data['last4']);
    }

    public function testCapture(): void
    {
        $this->mockResponse([
            'transactionId' => 'PT123456',
            'capturedAmount' => 150.00,
            'responseCode' => 'Captured',
        ]);

        $response = $this->api->payments->paytrace->capture([
            'transactionId' => 'PT123456',
            'amount' => 150.00,
        ]);

        $this->assertEquals('Captured', $response->data['responseCode']);
        $this->assertEquals(150.00, $response->data['capturedAmount']);
        $this->assertRequestPath('/paytrace/capture');
        $this->assertRequestMethod('POST');
    }

    public function testCapturePartial(): void
    {
        $this->mockResponse([
            'transactionId' => 'PT123456',
            'originalAmount' => 200.00,
            'capturedAmount' => 150.00,
        ]);

        $response = $this->api->payments->paytrace->capture([
            'transactionId' => 'PT123456',
            'amount' => 150.00,
        ]);

        $this->assertLessThan($response->data['originalAmount'], $response->data['capturedAmount']);
    }

    public function testSale(): void
    {
        $this->mockResponse([
            'transactionId' => 'PT345678',
            'approvalCode' => 'SAL789',
            'responseCode' => 'Approved',
            'amount' => 99.99,
            'captured' => true,
        ]);

        $response = $this->api->payments->paytrace->sale([
            'customerId' => 'CUST001',
            'amount' => 99.99,
        ]);

        $this->assertEquals('SAL789', $response->data['approvalCode']);
        $this->assertTrue($response->data['captured']);
        $this->assertRequestPath('/paytrace/sale');
        $this->assertRequestMethod('POST');
    }

    public function testRefund(): void
    {
        $this->mockResponse([
            'transactionId' => 'PT567890',
            'refundedAmount' => 50.00,
            'responseCode' => 'Refunded',
            'originalTransactionId' => 'PT345678',
        ]);

        $response = $this->api->payments->paytrace->refund([
            'transactionId' => 'PT345678',
            'amount' => 50.00,
        ]);

        $this->assertEquals('Refunded', $response->data['responseCode']);
        $this->assertEquals(50.00, $response->data['refundedAmount']);
        $this->assertRequestPath('/paytrace/refund');
        $this->assertRequestMethod('POST');
    }

    public function testRefundFull(): void
    {
        $this->mockResponse([
            'transactionId' => 'PT901234',
            'refundedAmount' => 99.99,
            'fullRefund' => true,
        ]);

        $response = $this->api->payments->paytrace->refund([
            'transactionId' => 'PT345678',
        ]);

        $this->assertTrue($response->data['fullRefund']);
    }

    public function testVoid(): void
    {
        $this->mockResponse([
            'transactionId' => 'PT123456',
            'responseCode' => 'Voided',
            'voidedAmount' => 150.00,
        ]);

        $response = $this->api->payments->paytrace->void([
            'transactionId' => 'PT123456',
        ]);

        $this->assertEquals('Voided', $response->data['responseCode']);
        $this->assertEquals(150.00, $response->data['voidedAmount']);
        $this->assertRequestPath('/paytrace/void');
        $this->assertRequestMethod('POST');
    }

    public function testVoidWithReason(): void
    {
        $this->mockResponse([
            'transactionId' => 'PT789012',
            'responseCode' => 'Voided',
            'reason' => 'Customer cancelled',
        ]);

        $response = $this->api->payments->paytrace->void([
            'transactionId' => 'PT789012',
            'reason' => 'Customer cancelled',
        ]);

        $this->assertEquals('Customer cancelled', $response->data['reason']);
    }
}
