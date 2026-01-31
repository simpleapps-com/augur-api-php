<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Payments\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class MonerisResourceTest extends AugurApiTestCase
{
    public function testPreAuth(): void
    {
        $this->mockResponse([
            'transactionId' => 'TXN123456',
            'authCode' => 'AUTH123',
            'responseCode' => '00',
            'message' => 'Approved',
            'amount' => 100.00,
        ]);

        $response = $this->api->payments->moneris->preAuth([
            'dataKey' => 'dk_test123',
            'amount' => 100.00,
            'orderId' => 'ORD001',
        ]);

        $this->assertEquals('TXN123456', $response->data['transactionId']);
        $this->assertEquals('AUTH123', $response->data['authCode']);
        $this->assertEquals('00', $response->data['responseCode']);
        $this->assertRequestPath('/moneris/pre-auth');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testPreAuthWithCvv(): void
    {
        $this->mockResponse([
            'transactionId' => 'TXN789012',
            'cvvResult' => 'M',
            'avsResult' => 'Y',
        ]);

        $response = $this->api->payments->moneris->preAuth([
            'dataKey' => 'dk_test456',
            'amount' => 250.00,
            'orderId' => 'ORD002',
            'cvv' => '123',
        ]);

        $this->assertEquals('M', $response->data['cvvResult']);
    }

    public function testPreAuthDeclined(): void
    {
        $this->mockResponse([
            'transactionId' => 'TXN345678',
            'responseCode' => '05',
            'message' => 'Declined',
            'approved' => false,
        ]);

        $response = $this->api->payments->moneris->preAuth([
            'dataKey' => 'dk_declined',
            'amount' => 500.00,
            'orderId' => 'ORD003',
        ]);

        $this->assertEquals('05', $response->data['responseCode']);
        $this->assertFalse($response->data['approved']);
    }

    public function testPreAuthComplete(): void
    {
        $this->mockResponse([
            'transactionId' => 'TXN123456',
            'authCode' => 'AUTH123',
            'responseCode' => '00',
            'message' => 'Completion Approved',
            'completedAmount' => 100.00,
        ]);

        $response = $this->api->payments->moneris->preAuthComplete([
            'transactionId' => 'TXN123456',
            'orderId' => 'ORD001',
            'amount' => 100.00,
        ]);

        $this->assertEquals('TXN123456', $response->data['transactionId']);
        $this->assertEquals('Completion Approved', $response->data['message']);
        $this->assertEquals(100.00, $response->data['completedAmount']);
        $this->assertRequestPath('/moneris/pre-auth-complete');
        $this->assertRequestMethod('GET');
    }

    public function testPreAuthCompletePartial(): void
    {
        $this->mockResponse([
            'transactionId' => 'TXN789012',
            'originalAmount' => 250.00,
            'completedAmount' => 200.00,
            'responseCode' => '00',
        ]);

        $response = $this->api->payments->moneris->preAuthComplete([
            'transactionId' => 'TXN789012',
            'orderId' => 'ORD002',
            'amount' => 200.00,
        ]);

        $this->assertEquals(250.00, $response->data['originalAmount']);
        $this->assertEquals(200.00, $response->data['completedAmount']);
    }
}
