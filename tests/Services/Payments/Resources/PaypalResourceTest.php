<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Payments\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class PaypalResourceTest extends AugurApiTestCase
{
    public function testCreateOrder(): void
    {
        $this->mockResponse([
            'id' => 'ORDER-1',
            'status' => 'CREATED',
        ]);

        $response = $this->api->payments->paypal->createOrder([], [
            'amount' => 100.00,
            'intent' => 'CAPTURE',
            'currencyCode' => 'USD',
            'returnUrl' => 'https://example.com/return',
            'cancelUrl' => 'https://example.com/cancel',
        ]);

        $this->assertEquals('ORDER-1', $response->data['id']);
        $this->assertEquals('CREATED', $response->data['status']);
        $this->assertRequestPath('/paypal/order');
        $this->assertRequestMethod('POST');
        $this->assertHasAuthHeader();
    }

    public function testCreateOrderAuthorize(): void
    {
        $this->mockResponse([
            'id' => 'ORDER-1',
            'status' => 'COMPLETED',
        ]);

        $response = $this->api->payments->paypal->createOrderAuthorize([], [
            'orderId' => 'ORDER-1',
        ]);

        $this->assertEquals('COMPLETED', $response->data['status']);
        $this->assertRequestPath('/paypal/order/authorize');
        $this->assertRequestMethod('POST');
    }

    public function testCreateOrderCapture(): void
    {
        $this->mockResponse([
            'id' => 'ORDER-1',
            'status' => 'COMPLETED',
        ]);

        $response = $this->api->payments->paypal->createOrderCapture([], [
            'orderId' => 'ORDER-1',
        ]);

        $this->assertEquals('ORDER-1', $response->data['id']);
        $this->assertRequestPath('/paypal/order/capture');
        $this->assertRequestMethod('POST');
    }

    public function testListOrderDetails(): void
    {
        $this->mockResponse([
            'id' => 'ORDER-1',
            'status' => 'APPROVED',
            'intent' => 'CAPTURE',
        ]);

        $response = $this->api->payments->paypal->listOrderDetails([
            'orderId' => 'ORDER-1',
        ]);

        $this->assertEquals('APPROVED', $response->data['status']);
        $this->assertRequestPath('/paypal/order/details');
        $this->assertRequestMethod('GET');
    }

    public function testListOrderReturn(): void
    {
        $this->mockResponse([
            'token' => 'EC-1',
            'payerId' => 'PAYER-1',
        ]);

        $response = $this->api->payments->paypal->listOrderReturn([
            'token' => 'EC-1',
            'siteId' => 'TEST123',
            'payerId' => 'PAYER-1',
        ]);

        $this->assertEquals('EC-1', $response->data['token']);
        $this->assertRequestPath('/paypal/order-return');
        $this->assertRequestMethod('GET');
    }

    public function testCreateAuthorizationCapture(): void
    {
        $this->mockResponse([
            'id' => 'CAP-1',
            'status' => 'COMPLETED',
        ]);

        $response = $this->api->payments->paypal->createAuthorizationCapture([], [
            'authorizationId' => 'AUTH-1',
            'amount' => 100.00,
            'finalCapture' => true,
        ]);

        $this->assertEquals('CAP-1', $response->data['id']);
        $this->assertRequestPath('/paypal/authorization/capture');
        $this->assertRequestMethod('POST');
    }

    public function testCreateAuthorizationVoid(): void
    {
        $this->mockResponse([
            'status' => 'VOIDED',
        ]);

        $response = $this->api->payments->paypal->createAuthorizationVoid([], [
            'authorizationId' => 'AUTH-1',
        ]);

        $this->assertEquals('VOIDED', $response->data['status']);
        $this->assertRequestPath('/paypal/authorization/void');
        $this->assertRequestMethod('POST');
    }

    public function testCreateCaptureRefund(): void
    {
        $this->mockResponse([
            'id' => 'REFUND-1',
            'status' => 'COMPLETED',
        ]);

        $response = $this->api->payments->paypal->createCaptureRefund([], [
            'captureId' => 'CAP-1',
            'amount' => 25.00,
            'noteToPayer' => 'Partial refund',
        ]);

        $this->assertEquals('REFUND-1', $response->data['id']);
        $this->assertRequestPath('/paypal/capture/refund');
        $this->assertRequestMethod('POST');
    }

    public function testListRefund(): void
    {
        $this->mockResponse([
            'id' => 'REFUND-1',
            'status' => 'COMPLETED',
            'amount' => 25.00,
        ]);

        $response = $this->api->payments->paypal->listRefund([
            'refundId' => 'REFUND-1',
        ]);

        $this->assertEquals(25.00, $response->data['amount']);
        $this->assertRequestPath('/paypal/refund');
        $this->assertRequestMethod('GET');
    }

    public function testCreateWebhook(): void
    {
        $this->mockResponse([
            'received' => true,
        ]);

        $response = $this->api->payments->paypal->createWebhook([
            'event_type' => 'PAYMENT.CAPTURE.COMPLETED',
        ], [
            'siteId' => 'TEST123',
        ]);

        $this->assertTrue($response->data['received']);
        $this->assertRequestPath('/paypal/webhook');
        $this->assertRequestMethod('POST');
    }
}
