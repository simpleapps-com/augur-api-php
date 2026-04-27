<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Orders\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class PickTicketsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['pickTicketNo' => 1001, 'orderNo' => 12345, 'status' => 'pending'],
            ['pickTicketNo' => 1002, 'orderNo' => 12346, 'status' => 'picked'],
        ]);

        $response = $this->api->orders->pickTickets->list();

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1001, $data[0]['pickTicketNo']);
        $this->assertEquals('pending', $data[0]['status']);
        $this->assertRequestPath('/pick-tickets');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['pickTicketNo' => 1001, 'status' => 'pending'],
        ]);

        $response = $this->api->orders->pickTickets->list([
            'printedFlag' => 'N',
            'limit' => 10,
        ]);

        $this->assertCount(1, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('pending', $data[0]['status']);
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
            'pickTicketNo' => 1001,
            'orderNo' => 12345,
            'warehouseId' => 'WH01',
            'status' => 'pending',
            'createdDate' => '2024-01-15',
            'lineCount' => 5,
        ]);

        $response = $this->api->orders->pickTickets->get(1001.0);

        $this->assertEquals(1001, $response->data['pickTicketNo']);
        $this->assertEquals(12345, $response->data['orderNo']);
        $this->assertEquals(5, $response->data['lineCount']);
        $this->assertRequestPath('/pick-tickets/1001');
        $this->assertRequestMethod('GET');
    }

    public function testGetWithDifferentTicket(): void
    {
        $this->mockResponse([
            'pickTicketNo' => 9999,
            'status' => 'picked',
        ]);

        $response = $this->api->orders->pickTickets->get(9999.0);

        $this->assertEquals(9999, $response->data['pickTicketNo']);
        $this->assertRequestPath('/pick-tickets/9999');
    }

    public function testListLines(): void
    {
        $this->mockListResponse([
            ['lineNumber' => 1, 'itemId' => 'ITEM001', 'quantity' => 5, 'binLocation' => 'A1-01'],
            ['lineNumber' => 2, 'itemId' => 'ITEM002', 'quantity' => 3, 'binLocation' => 'B2-05'],
        ]);

        $response = $this->api->orders->pickTickets->listLines(1001.0);

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('ITEM001', $data[0]['itemId']);
        $this->assertEquals('A1-01', $data[0]['binLocation']);
        $this->assertRequestPath('/pick-tickets/1001/lines');
        $this->assertRequestMethod('GET');
    }

    public function testListLinesWithParams(): void
    {
        $this->mockListResponse([
            ['lineNumber' => 1, 'itemId' => 'ITEM001'],
        ]);

        $response = $this->api->orders->pickTickets->listLines(1001.0, [
            'limit' => 10,
        ]);

        $this->assertCount(1, $response->data);
    }

    public function testListLinesEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->orders->pickTickets->listLines(9999.0);

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }

    public function testGetLines(): void
    {
        $this->mockResponse([
            'pickTicketNo' => 1001,
            'lineNumber' => 1,
            'itemId' => 'ITEM001',
            'description' => 'Test Item',
            'quantity' => 5,
            'quantityPicked' => 3,
            'binLocation' => 'A1-01',
            'lotNumber' => 'LOT123',
        ]);

        // Generated signature: getLines(float $pickTicketNo, float $lineNumber, ...)
        $response = $this->api->orders->pickTickets->getLines(1001.0, 1.0);

        $this->assertEquals(1, $response->data['lineNumber']);
        $this->assertEquals('ITEM001', $response->data['itemId']);
        $this->assertEquals(5, $response->data['quantity']);
        $this->assertEquals(3, $response->data['quantityPicked']);
        $this->assertRequestPath('/pick-tickets/1001/lines/1');
        $this->assertRequestMethod('GET');
    }

    public function testGetLinesWithDifferentLine(): void
    {
        $this->mockResponse([
            'pickTicketNo' => 2002,
            'lineNumber' => 5,
            'itemId' => 'ITEM005',
        ]);

        $response = $this->api->orders->pickTickets->getLines(2002.0, 5.0);

        $this->assertEquals(5, $response->data['lineNumber']);
        $this->assertRequestPath('/pick-tickets/2002/lines/5');
    }
}
