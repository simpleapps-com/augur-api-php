<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for OeContactsCustomerResource.
 */
final class OeContactsCustomerResourceTest extends AugurApiTestCase
{
    public function testRefresh(): void
    {
        $this->mockResponse(['refreshed' => true, 'timestamp' => '2024-01-15T12:00:00Z']);

        $response = $this->api->customers->oeContactsCustomer->refresh();

        $this->assertTrue($response->data['refreshed']);
        $this->assertRequestPath('/oe-contacts-customer/refresh');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
