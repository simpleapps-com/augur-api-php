<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrSite\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for TrainingResource.
 */
final class TrainingResourceTest extends AugurApiTestCase
{
    // Training Sets

    public function testList(): void
    {
        $this->mockListResponse([
            ['trainingSetUid' => 1, 'name' => 'Training Set A', 'status' => 'active'],
            ['trainingSetUid' => 2, 'name' => 'Training Set B', 'status' => 'draft'],
        ]);

        $response = $this->api->agrSite->training->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Training Set A', $response->data[0]['name']);
        $this->assertRequestPath('/training');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['trainingSetUid' => 1, 'name' => 'Training Set A'],
        ]);

        $response = $this->api->agrSite->training->list(['limit' => 10, 'orderBy' => 'name']);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'trainingSetUid' => 1,
            'name' => 'Training Set A',
            'status' => 'active',
            'description' => 'A training set for testing',
        ]);

        $response = $this->api->agrSite->training->get(1);

        $this->assertEquals(1, $response->data['trainingSetUid']);
        $this->assertEquals('Training Set A', $response->data['name']);
        $this->assertRequestPath('/training/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'trainingSetUid' => 3,
            'name' => 'New Training Set',
            'status' => 'draft',
        ]);

        $response = $this->api->agrSite->training->create([
            'name' => 'New Training Set',
            'description' => 'A new training set',
        ]);

        $this->assertEquals(3, $response->data['trainingSetUid']);
        $this->assertEquals('New Training Set', $response->data['name']);
        $this->assertRequestPath('/training');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'trainingSetUid' => 1,
            'name' => 'Updated Training Set',
            'status' => 'active',
        ]);

        $response = $this->api->agrSite->training->update(1, ['name' => 'Updated Training Set']);

        $this->assertEquals('Updated Training Set', $response->data['name']);
        $this->assertRequestPath('/training/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->agrSite->training->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/training/1');
        $this->assertRequestMethod('DELETE');
    }

    // Conversations

    public function testListConversations(): void
    {
        $this->mockListResponse([
            ['trainingConvUid' => 1, 'title' => 'Conversation A'],
            ['trainingConvUid' => 2, 'title' => 'Conversation B'],
        ]);

        $response = $this->api->agrSite->training->listConversations(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Conversation A', $response->data[0]['title']);
        $this->assertRequestPath('/training/1/conversations');
        $this->assertRequestMethod('GET');
    }

    public function testListConversationsWithParams(): void
    {
        $this->mockListResponse([
            ['trainingConvUid' => 1, 'title' => 'Conversation A'],
        ]);

        $response = $this->api->agrSite->training->listConversations(1, ['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testCreateConversation(): void
    {
        $this->mockResponse([
            'trainingConvUid' => 3,
            'title' => 'New Conversation',
        ]);

        $response = $this->api->agrSite->training->createConversation(1, [
            'title' => 'New Conversation',
        ]);

        $this->assertEquals(3, $response->data['trainingConvUid']);
        $this->assertEquals('New Conversation', $response->data['title']);
        $this->assertRequestPath('/training/1/conversations');
        $this->assertRequestMethod('POST');
    }

    public function testGetConversation(): void
    {
        $this->mockResponse([
            'trainingConvUid' => 1,
            'title' => 'Conversation A',
            'messages' => [],
        ]);

        $response = $this->api->agrSite->training->getConversation(1, 1);

        $this->assertEquals(1, $response->data['trainingConvUid']);
        $this->assertEquals('Conversation A', $response->data['title']);
        $this->assertRequestPath('/training/1/conversations/1');
        $this->assertRequestMethod('GET');
    }

    public function testUpdateConversation(): void
    {
        $this->mockResponse([
            'trainingConvUid' => 1,
            'title' => 'Updated Conversation',
        ]);

        $response = $this->api->agrSite->training->updateConversation(1, 1, [
            'title' => 'Updated Conversation',
        ]);

        $this->assertEquals('Updated Conversation', $response->data['title']);
        $this->assertRequestPath('/training/1/conversations/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDeleteConversation(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->agrSite->training->deleteConversation(1, 1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/training/1/conversations/1');
        $this->assertRequestMethod('DELETE');
    }

    // Messages

    public function testListMessages(): void
    {
        $this->mockListResponse([
            ['trainingMsgUid' => 1, 'role' => 'user', 'content' => 'Hello'],
            ['trainingMsgUid' => 2, 'role' => 'assistant', 'content' => 'Hi there!'],
        ]);

        $response = $this->api->agrSite->training->listMessages(1, 1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('user', $response->data[0]['role']);
        $this->assertEquals('Hello', $response->data[0]['content']);
        $this->assertRequestPath('/training/1/conversations/1/messages');
        $this->assertRequestMethod('GET');
    }

    public function testListMessagesWithParams(): void
    {
        $this->mockListResponse([
            ['trainingMsgUid' => 1, 'role' => 'user', 'content' => 'Hello'],
        ]);

        $response = $this->api->agrSite->training->listMessages(1, 1, ['limit' => 10]);

        $this->assertCount(1, $response->data);
    }

    public function testGetMessage(): void
    {
        $this->mockResponse([
            'trainingMsgUid' => 1,
            'role' => 'user',
            'content' => 'Hello',
        ]);

        $response = $this->api->agrSite->training->getMessage(1, 1, 1);

        $this->assertEquals(1, $response->data['trainingMsgUid']);
        $this->assertEquals('user', $response->data['role']);
        $this->assertRequestPath('/training/1/conversations/1/messages/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreateMessage(): void
    {
        $this->mockResponse([
            'trainingMsgUid' => 3,
            'role' => 'user',
            'content' => 'New message',
        ]);

        $response = $this->api->agrSite->training->createMessage(1, 1, [
            'role' => 'user',
            'content' => 'New message',
        ]);

        $this->assertEquals(3, $response->data['trainingMsgUid']);
        $this->assertEquals('New message', $response->data['content']);
        $this->assertRequestPath('/training/1/conversations/1/messages');
        $this->assertRequestMethod('POST');
    }

    public function testUpdateMessage(): void
    {
        $this->mockResponse([
            'trainingMsgUid' => 1,
            'role' => 'user',
            'content' => 'Updated message',
        ]);

        $response = $this->api->agrSite->training->updateMessage(1, 1, 1, [
            'content' => 'Updated message',
        ]);

        $this->assertEquals('Updated message', $response->data['content']);
        $this->assertRequestPath('/training/1/conversations/1/messages/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDeleteMessage(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->agrSite->training->deleteMessage(1, 1, 1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/training/1/conversations/1/messages/1');
        $this->assertRequestMethod('DELETE');
    }
}
