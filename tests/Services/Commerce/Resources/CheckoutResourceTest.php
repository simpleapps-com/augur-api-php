<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Commerce\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class CheckoutResourceTest extends AugurApiTestCase
{
    public function testCreate(): void
    {
        $this->mockResponse(['checkoutUid' => 1, 'status' => 'pending']);

        $response = $this->api->commerce->checkout->create(['customer' => 'test']);

        $this->assertEquals(1, $response->data['checkoutUid']);
        $this->assertRequestPath('/checkout');
        $this->assertRequestMethod('POST');
    }

    public function testGet(): void
    {
        $this->mockResponse(['checkoutUid' => 1, 'status' => 'pending']);

        $response = $this->api->commerce->checkout->get(1);

        $this->assertEquals(1, $response->data['checkoutUid']);
        $this->assertRequestPath('/checkout/1');
        $this->assertRequestMethod('GET');
    }

    public function testUpdateActivate(): void
    {
        $this->mockResponse(['checkoutUid' => 1, 'status' => 'active']);

        $response = $this->api->commerce->checkout->updateActivate(1);

        $this->assertEquals('active', $response->data['status']);
        $this->assertRequestPath('/checkout/1/activate');
        $this->assertRequestMethod('PUT');
    }

    public function testListDoc(): void
    {
        $this->mockResponse(['doc' => 'html-content']);

        $response = $this->api->commerce->checkout->listDoc(1);

        $this->assertEquals('html-content', $response->data['doc']);
        $this->assertRequestPath('/checkout/1/doc');
        $this->assertRequestMethod('GET');
    }

    public function testGetDocAlias(): void
    {
        $this->mockResponse(['doc' => 'html-content']);

        $response = $this->api->commerce->checkout->getDoc(1);

        $this->assertRequestPath('/checkout/1/doc');
        $this->assertRequestMethod('GET');
    }

    public function testCreateProphet21Hdr(): void
    {
        $this->mockResponse(['prophet21HdrUid' => 10]);

        $response = $this->api->commerce->checkout->createProphet21Hdr(1);

        $this->assertEquals(10, $response->data['prophet21HdrUid']);
        $this->assertRequestPath('/checkout/1/prophet21-hdr');
        $this->assertRequestMethod('POST');
    }

    public function testCreateProphet21HdrProphet21Line(): void
    {
        $this->mockResponse(['lineNo' => 1]);

        $response = $this->api->commerce->checkout->createProphet21HdrProphet21Line(1, 10);

        $this->assertEquals(1, $response->data['lineNo']);
        $this->assertRequestPath('/checkout/1/prophet21-hdr/10/prophet21-line');
        $this->assertRequestMethod('POST');
    }

    public function testUpdateValidate(): void
    {
        $this->mockResponse(['valid' => true]);

        $response = $this->api->commerce->checkout->updateValidate(1);

        $this->assertTrue($response->data['valid']);
        $this->assertRequestPath('/checkout/1/validate');
        $this->assertRequestMethod('PUT');
    }
}
