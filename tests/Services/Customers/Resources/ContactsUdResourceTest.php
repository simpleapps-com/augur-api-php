<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ContactsUdResource (User Defined fields).
 */
final class ContactsUdResourceTest extends AugurApiTestCase
{
    public function testGet(): void
    {
        $this->mockResponse([
            'contactId' => 123,
            'udField1' => 'Custom Value 1',
            'udField2' => 'Custom Value 2',
        ]);

        $response = $this->api->customers->contactsUd->get(123);

        $this->assertEquals(123, $response->data['contactId']);
        $this->assertEquals('Custom Value 1', $response->data['udField1']);
        $this->assertRequestPath('/contacts-ud/123');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
