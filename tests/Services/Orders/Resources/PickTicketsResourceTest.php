<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Orders\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class PickTicketsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['pickTicketNo' => 'PT001', 'orderNo' => 'ORD001', 'status' => 'pending'],
            ['pickTicketNo' => 'PT002', 'orderNo' => 'ORD002', 'status' => 'picked'],
        ]);

        $response = $this->api->orders->pickTickets->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('PT001', $response->data[0]['pickTicketNo']);
        $this->assertEquals('pending', $response->data[0]['status']);
        $this->assertRequestPath('/pick-tickets');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['pickTicketNo' => 'PT001', 'status' => 'pending'],
        ]);

        $response = $this->api->orders->pickTickets->list([
            'status' => 'pending',
            'limit' => 10,
        ]);

        $this->assertCount(1, $response->data);
        $this->assertEquals('pending', $response->data[0]['status']);
    }

    public function testListEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->orders->pickTickets->list();

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'pickTicketNo' => 'PT001',
            'orderNo' => 'ORD001',
            'warehouseId' => 'WH01',
            'status' => 'pending',
            'createdDate' => '2024-01-15',
            'lineCount' => 5,
        ]);

        $response = $this->api->orders->pickTickets->get('PT001');

        $this->assertEquals('PT001', $response->data['pickTicketNo']);
        $this->assertEquals('ORD001', $response->data['orderNo']);
        $this->assertEquals(5, $response->data['lineCount']);
        $this->assertRequestPath('/pick-tickets/PT001');
        $this->assertRequestMethod('GET');
    }

    public function testGetWithDifferentTicket(): void
    {
        $this->mockResponse([
            'pickTicketNo' => 'PT999',
            'status' => 'picked',
        ]);

        $response = $this->api->orders->pickTickets->get('PT999');

        $this->assertEquals('PT999', $response->data['pickTicketNo']);
        $this->assertRequestPath('/pick-tickets/PT999');
    }

    public function testGetLines(): void
    {
        $this->mockListResponse([
            ['lineNumber' => 1, 'itemId' => 'ITEM001', 'quantity' => 5, 'binLocation' => 'A1-01'],
            ['lineNumber' => 2, 'itemId' => 'ITEM002', 'quantity' => 3, 'binLocation' => 'B2-05'],
        ]);

        $response = $this->api->orders->pickTickets->getLines('PT001');

        $this->assertCount(2, $response->data);
        $this->assertEquals('ITEM001', $response->data[0]['itemId']);
        $this->assertEquals('A1-01', $response->data[0]['binLocation']);
        $this->assertRequestPath('/pick-tickets/PT001/lines');
        $this->assertRequestMethod('GET');
    }

    public function testGetLinesWithParams(): void
    {
        $this->mockListResponse([
            ['lineNumber' => 1, 'itemId' => 'ITEM001', 'status' => 'picked'],
        ]);

        $response = $this->api->orders->pickTickets->getLines('PT001', [
            'status' => 'picked',
        ]);

        $this->assertCount(1, $response->data);
    }

    public function testGetLinesEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->orders->pickTickets->getLines('PT999');

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }

    public function testGetLine(): void
    {
        $this->mockResponse([
            'pickTicketNo' => 'PT001',
            'lineNumber' => 1,
            'itemId' => 'ITEM001',
            'description' => 'Test Item',
            'quantity' => 5,
            'quantityPicked' => 3,
            'binLocation' => 'A1-01',
            'lotNumber' => 'LOT123',
        ]);

        $response = $this->api->orders->pickTickets->getLine('PT001', 1);

        $this->assertEquals(1, $response->data['lineNumber']);
        $this->assertEquals('ITEM001', $response->data['itemId']);
        $this->assertEquals(5, $response->data['quantity']);
        $this->assertEquals(3, $response->data['quantityPicked']);
        $this->assertRequestPath('/pick-tickets/PT001/lines/1');
        $this->assertRequestMethod('GET');
    }

    public function testGetLineWithDifferentLine(): void
    {
        $this->mockResponse([
            'pickTicketNo' => 'PT002',
            'lineNumber' => 5,
            'itemId' => 'ITEM005',
        ]);

        $response = $this->api->orders->pickTickets->getLine('PT002', 5);

        $this->assertEquals(5, $response->data['lineNumber']);
        $this->assertRequestPath('/pick-tickets/PT002/lines/5');
    }
}
