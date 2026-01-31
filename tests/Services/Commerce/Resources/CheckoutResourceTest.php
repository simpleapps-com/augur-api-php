<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Commerce\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class CheckoutResourceTest extends AugurApiTestCase
{
    public function testCreate(): void
    {
        $this->mockResponse([
            'checkoutUid' => 100,
            'cartHdrUid' => 123,
            'status' => 'pending',
        ]);

        $response = $this->api->commerce->checkout->create([
            'cartHdrUid' => 123,
            'customerId' => 'CUST001',
        ]);

        $this->assertEquals(100, $response->data['checkoutUid']);
        $this->assertEquals('pending', $response->data['status']);
        $this->assertRequestPath('/checkout');
        $this->assertRequestMethod('POST');
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'checkoutUid' => 100,
            'cartHdrUid' => 123,
            'status' => 'pending',
            'total' => 199.99,
        ]);

        $response = $this->api->commerce->checkout->get(100);

        $this->assertEquals(100, $response->data['checkoutUid']);
        $this->assertEquals(199.99, $response->data['total']);
        $this->assertRequestPath('/checkout/100');
        $this->assertRequestMethod('GET');
    }

    public function testGetDoc(): void
    {
        $this->mockResponse([
            'checkoutUid' => 100,
            'documentType' => 'order',
            'lines' => [
                ['lineNo' => 1, 'itemId' => 'ITEM001'],
            ],
        ]);

        $response = $this->api->commerce->checkout->getDoc(100);

        $this->assertEquals('order', $response->data['documentType']);
        $this->assertIsArray($response->data['lines']);
        $this->assertRequestPath('/checkout/100/doc');
        $this->assertRequestMethod('GET');
    }

    public function testValidate(): void
    {
        $this->mockResponse([
            'checkoutUid' => 100,
            'valid' => true,
            'errors' => [],
        ]);

        $response = $this->api->commerce->checkout->validate(100);

        $this->assertTrue($response->data['valid']);
        $this->assertEmpty($response->data['errors']);
        $this->assertRequestPath('/checkout/100/validate');
        $this->assertRequestMethod('PUT');
    }

    public function testValidateWithErrors(): void
    {
        $this->mockResponse([
            'checkoutUid' => 100,
            'valid' => false,
            'errors' => ['Invalid shipping address'],
        ]);

        $response = $this->api->commerce->checkout->validate(100);

        $this->assertFalse($response->data['valid']);
        $this->assertNotEmpty($response->data['errors']);
    }

    public function testActivate(): void
    {
        $this->mockResponse([
            'checkoutUid' => 100,
            'status' => 'active',
            'orderNo' => 'ORD001',
        ]);

        $response = $this->api->commerce->checkout->activate(100);

        $this->assertEquals('active', $response->data['status']);
        $this->assertEquals('ORD001', $response->data['orderNo']);
        $this->assertRequestPath('/checkout/100/activate');
        $this->assertRequestMethod('PUT');
    }

    public function testCreateProphet21Hdr(): void
    {
        $this->mockResponse([
            'checkoutUid' => 100,
            'prophet21HdrUid' => 200,
            'status' => 'created',
        ]);

        $response = $this->api->commerce->checkout->createProphet21Hdr(100, [
            'customerId' => 'CUST001',
            'shipVia' => 'GROUND',
        ]);

        $this->assertEquals(200, $response->data['prophet21HdrUid']);
        $this->assertRequestPath('/checkout/100/prophet21-hdr');
        $this->assertRequestMethod('POST');
    }

    public function testAddProphet21Line(): void
    {
        $this->mockResponse([
            'checkoutUid' => 100,
            'prophet21HdrUid' => 200,
            'prophet21LineUid' => 300,
            'itemId' => 'ITEM001',
            'quantity' => 5,
        ]);

        $response = $this->api->commerce->checkout->addProphet21Line(100, 200, [
            'itemId' => 'ITEM001',
            'quantity' => 5,
        ]);

        $this->assertEquals(300, $response->data['prophet21LineUid']);
        $this->assertEquals('ITEM001', $response->data['itemId']);
        $this->assertRequestPath('/checkout/100/prophet21-hdr/200/prophet21-line');
        $this->assertRequestMethod('POST');
    }

    public function testAddProphet21LineWithPricing(): void
    {
        $this->mockResponse([
            'checkoutUid' => 100,
            'prophet21HdrUid' => 200,
            'prophet21LineUid' => 301,
            'itemId' => 'ITEM002',
            'quantity' => 10,
            'unitPrice' => 25.50,
        ]);

        $response = $this->api->commerce->checkout->addProphet21Line(100, 200, [
            'itemId' => 'ITEM002',
            'quantity' => 10,
            'unitPrice' => 25.50,
        ]);

        $this->assertEquals(25.50, $response->data['unitPrice']);
    }
}
