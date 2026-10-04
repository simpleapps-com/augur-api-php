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

        $this->assertEquals(1, self::at($response->data, 'checkoutUid'));
        $this->assertRequestPath('/checkout');
        $this->assertRequestMethod('POST');
    }

    public function testGet(): void
    {
        $this->mockResponse(['checkoutUid' => 1, 'status' => 'pending']);

        $response = $this->api->commerce->checkout->get(1);

        $this->assertEquals(1, self::at($response->data, 'checkoutUid'));
        $this->assertRequestPath('/checkout/1');
        $this->assertRequestMethod('GET');
    }

    public function testUpdateActivate(): void
    {
        $this->mockResponse(['checkoutUid' => 1, 'status' => 'active']);

        $response = $this->api->commerce->checkout->updateActivate(1);

        $this->assertEquals('active', self::at($response->data, 'status'));
        $this->assertRequestPath('/checkout/1/activate');
        $this->assertRequestMethod('PUT');
    }

    public function testListDoc(): void
    {
        $this->mockResponse(['doc' => 'html-content']);

        $response = $this->api->commerce->checkout->listDoc(1);

        $this->assertEquals('html-content', self::at($response->data, 'doc'));
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

    public function testUpdateValidate(): void
    {
        $this->mockResponse(['valid' => true]);

        $response = $this->api->commerce->checkout->updateValidate(1);

        $this->assertTrue(self::at($response->data, 'valid'));
        $this->assertRequestPath('/checkout/1/validate');
        $this->assertRequestMethod('PUT');
    }
}
