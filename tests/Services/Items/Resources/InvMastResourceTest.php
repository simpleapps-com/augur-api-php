<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Services\Items\Schemas\InvMast;
use AugurApi\Services\Items\Schemas\InvMastListParams;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for InvMastResource.
 *
 * @covers \AugurApi\Services\Items\Resources\InvMastResource
 */
final class InvMastResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 100, 'itemId' => 'ITEM001', 'itemDesc' => 'Test Item 1'],
            ['invMastUid' => 101, 'itemId' => 'ITEM002', 'itemDesc' => 'Test Item 2'],
        ]);

        $response = $this->api->items->invMast->list();

        $this->assertCount(2, $response->data);
        $this->assertInstanceOf(InvMast::class, $response->data[0]);
        $this->assertEquals(100, $response->data[0]->invMastUid);
        $this->assertEquals('ITEM001', $response->data[0]->itemId);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 100, 'itemId' => 'ITEM001'],
        ], 500);

        $params = new InvMastListParams(limit: 25, offset: 0);
        $response = $this->api->items->invMast->list($params);

        $this->assertCount(1, $response->data);
        $this->assertEquals(500, $response->total);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithArray(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 100, 'itemId' => 'ITEM001'],
        ]);

        $response = $this->api->items->invMast->list(['limit' => 10]);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'invMastUid' => 100,
            'itemId' => 'ITEM001',
            'itemDesc' => 'Test Item 1',
            'unitPrice' => 99.99,
        ]);

        $response = $this->api->items->invMast->get(100);

        $this->assertInstanceOf(InvMast::class, $response->data);
        $this->assertEquals(100, $response->data->invMastUid);
        $this->assertEquals('ITEM001', $response->data->itemId);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/100');
    }

    public function testLookup(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 100, 'itemId' => 'ITEM001'],
            ['invMastUid' => 101, 'itemId' => 'ITEM002'],
        ]);

        $response = $this->api->items->invMast->lookup(['q' => 'ITEM']);

        $this->assertCount(2, $response->data);
        $this->assertInstanceOf(InvMast::class, $response->data[0]);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/lookup');
    }

    public function testGetDoc(): void
    {
        $this->mockResponse([
            'invMastUid' => 100,
            'documents' => [
                ['docUid' => 1, 'docType' => 'pdf'],
                ['docUid' => 2, 'docType' => 'image'],
            ],
        ]);

        $response = $this->api->items->invMast->getDoc(100);

        $this->assertEquals(100, $response->data['invMastUid']);
        $this->assertCount(2, $response->data['documents']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/100/doc');
    }

    public function testGetStock(): void
    {
        $this->mockListResponse([
            ['locationId' => 'WH001', 'qtyOnHand' => 50, 'qtyAvailable' => 45],
            ['locationId' => 'WH002', 'qtyOnHand' => 30, 'qtyAvailable' => 30],
        ]);

        $response = $this->api->items->invMast->getStock(100);

        $this->assertCount(2, $response->data);
        $this->assertEquals('WH001', $response->data[0]['locationId']);
        $this->assertEquals(50, $response->data[0]['qtyOnHand']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/100/stock');
    }

    public function testGetAlternateCode(): void
    {
        $this->mockListResponse([
            ['alternateCode' => 'ALT001', 'codeType' => 'UPC'],
            ['alternateCode' => 'ALT002', 'codeType' => 'MPN'],
        ]);

        $response = $this->api->items->invMast->getAlternateCode(100);

        $this->assertCount(2, $response->data);
        $this->assertEquals('ALT001', $response->data[0]['alternateCode']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/100/alternate-code');
    }

    public function testGetAlternateCodeWithParams(): void
    {
        $this->mockListResponse([
            ['alternateCode' => 'ALT001', 'codeType' => 'UPC'],
        ]);

        $response = $this->api->items->invMast->getAlternateCode(100, ['codeType' => 'UPC']);

        $this->assertCount(1, $response->data);
    }

    public function testGetAttributes(): void
    {
        $this->mockListResponse([
            ['attributeUid' => 1, 'name' => 'Color', 'value' => 'Red'],
            ['attributeUid' => 2, 'name' => 'Size', 'value' => 'Large'],
        ]);

        $response = $this->api->items->invMast->getAttributes(100);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Color', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/100/attributes');
    }

    public function testGetAttributesWithParams(): void
    {
        $this->mockListResponse([
            ['attributeUid' => 1, 'name' => 'Color'],
        ]);

        $response = $this->api->items->invMast->getAttributes(100, ['limit' => 10]);

        $this->assertCount(1, $response->data);
    }

    public function testCreateAttributes(): void
    {
        $this->mockResponse(['success' => true, 'created' => 1]);

        $response = $this->api->items->invMast->createAttributes(100, [
            'attributeUid' => 5,
            'value' => 'Medium',
        ]);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/inv-mast/100/attributes');
    }

    public function testGetAttributeValues(): void
    {
        $this->mockListResponse([
            ['attributeValueUid' => 1, 'value' => 'Red'],
            ['attributeValueUid' => 2, 'value' => 'Blue'],
        ]);

        $response = $this->api->items->invMast->getAttributeValues(100, 1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Red', $response->data[0]['value']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/100/attributes/1/values');
    }

    public function testGetAttributeValuesWithParams(): void
    {
        $this->mockListResponse([
            ['attributeValueUid' => 1, 'value' => 'Red'],
        ]);

        $response = $this->api->items->invMast->getAttributeValues(100, 1, ['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testCreateAttributeValues(): void
    {
        $this->mockResponse(['attributeValueUid' => 3, 'value' => 'Green']);

        $response = $this->api->items->invMast->createAttributeValues(100, 1, ['value' => 'Green']);

        $this->assertEquals(3, $response->data['attributeValueUid']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/inv-mast/100/attributes/1/values');
    }

    public function testUpdateAttributeValue(): void
    {
        $this->mockResponse(['attributeValueUid' => 1, 'value' => 'Dark Red']);

        $response = $this->api->items->invMast->updateAttributeValue(100, 1, 1, ['value' => 'Dark Red']);

        $this->assertEquals('Dark Red', $response->data['value']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/inv-mast/100/attributes/1/values/1');
    }

    public function testDeleteAttributeValue(): void
    {
        $this->mockResponse(['success' => true]);

        $response = $this->api->items->invMast->deleteAttributeValue(100, 1, 1);

        $this->assertTrue($response->data);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/inv-mast/100/attributes/1/values/1');
    }

    public function testListFaq(): void
    {
        $this->mockListResponse([
            ['invMastFaqUid' => 1, 'question' => 'What is this?', 'answer' => 'A test item.'],
            ['invMastFaqUid' => 2, 'question' => 'Is it good?', 'answer' => 'Yes.'],
        ]);

        $response = $this->api->items->invMast->listFaq(100);

        $this->assertCount(2, $response->data);
        $this->assertEquals('What is this?', $response->data[0]['question']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/100/faq');
    }

    public function testListFaqWithParams(): void
    {
        $this->mockListResponse([
            ['invMastFaqUid' => 1, 'question' => 'What is this?'],
        ], 10);

        $response = $this->api->items->invMast->listFaq(100, ['limit' => 5]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(10, $response->total);
    }

    public function testGetFaq(): void
    {
        $this->mockResponse([
            'invMastFaqUid' => 1,
            'question' => 'What is this?',
            'answer' => 'A test item.',
        ]);

        $response = $this->api->items->invMast->getFaq(100, 1);

        $this->assertEquals(1, $response->data['invMastFaqUid']);
        $this->assertEquals('What is this?', $response->data['question']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/100/faq/1');
    }

    public function testCreateFaq(): void
    {
        $this->mockResponse([
            'invMastFaqUid' => 3,
            'question' => 'New question?',
            'answer' => 'New answer.',
        ]);

        $response = $this->api->items->invMast->createFaq(100, [
            'question' => 'New question?',
            'answer' => 'New answer.',
        ]);

        $this->assertEquals(3, $response->data['invMastFaqUid']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/inv-mast/100/faq');
    }

    public function testUpdateFaq(): void
    {
        $this->mockResponse([
            'invMastFaqUid' => 1,
            'question' => 'Updated question?',
            'answer' => 'Updated answer.',
        ]);

        $response = $this->api->items->invMast->updateFaq(100, 1, [
            'question' => 'Updated question?',
            'answer' => 'Updated answer.',
        ]);

        $this->assertEquals('Updated question?', $response->data['question']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/inv-mast/100/faq/1');
    }

    public function testDeleteFaq(): void
    {
        $this->mockResponse(['success' => true]);

        $response = $this->api->items->invMast->deleteFaq(100, 1);

        $this->assertTrue($response->data);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/inv-mast/100/faq/1');
    }

    public function testGetAccessories(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 200, 'itemId' => 'ACC001'],
            ['invMastUid' => 201, 'itemId' => 'ACC002'],
        ]);

        $response = $this->api->items->invMast->getAccessories(100);

        $this->assertCount(2, $response->data);
        $this->assertEquals('ACC001', $response->data[0]['itemId']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/100/inv-accessory');
    }

    public function testGetAccessoriesWithParams(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 200, 'itemId' => 'ACC001'],
        ], 20);

        $response = $this->api->items->invMast->getAccessories(100, ['limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(20, $response->total);
    }

    public function testGetSubstitutes(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 300, 'itemId' => 'SUB001'],
            ['invMastUid' => 301, 'itemId' => 'SUB002'],
        ]);

        $response = $this->api->items->invMast->getSubstitutes(100);

        $this->assertCount(2, $response->data);
        $this->assertEquals('SUB001', $response->data[0]['itemId']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/100/inv-sub');
    }

    public function testGetSubstitutesWithParams(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 300, 'itemId' => 'SUB001'],
        ], 15);

        $response = $this->api->items->invMast->getSubstitutes(100, ['limit' => 5]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(15, $response->total);
    }

    public function testGetLocationBins(): void
    {
        $this->mockListResponse([
            ['bin' => 'A-01-01', 'qtyOnHand' => 10],
            ['bin' => 'A-01-02', 'qtyOnHand' => 5],
        ]);

        $response = $this->api->items->invMast->getLocationBins(100, 1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('A-01-01', $response->data[0]['bin']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/100/locations/1/bins');
    }

    public function testGetLocationBinsWithParams(): void
    {
        $this->mockListResponse([
            ['bin' => 'A-01-01', 'qtyOnHand' => 10],
        ], 50);

        $response = $this->api->items->invMast->getLocationBins(100, 1, ['limit' => 25]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
    }

    public function testGetLocationBin(): void
    {
        $this->mockResponse([
            'bin' => 'A-01-01',
            'locationId' => 1,
            'invMastUid' => 100,
            'qtyOnHand' => 10,
            'minQty' => 5,
            'maxQty' => 20,
        ]);

        $response = $this->api->items->invMast->getLocationBin(100, 1, 'A-01-01');

        $this->assertEquals('A-01-01', $response->data['bin']);
        $this->assertEquals(10, $response->data['qtyOnHand']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/100/locations/1/bins/A-01-01');
    }

    public function testGetSimilar(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 400, 'itemId' => 'SIM001', 'similarity' => 0.95],
            ['invMastUid' => 401, 'itemId' => 'SIM002', 'similarity' => 0.85],
        ]);

        $response = $this->api->items->invMast->getSimilar(100);

        $this->assertCount(2, $response->data);
        $this->assertEquals('SIM001', $response->data[0]['itemId']);
        $this->assertEquals(0.95, $response->data[0]['similarity']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast/100/similar');
    }
}
