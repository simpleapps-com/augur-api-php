<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrSite\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for SettingsResource.
 */
final class SettingsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['settingsUid' => 1, 'key' => 'theme', 'value' => 'dark'],
            ['settingsUid' => 2, 'key' => 'language', 'value' => 'en'],
        ]);

        $response = $this->api->agrSite->settings->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('theme', $response->data[0]['key']);
        $this->assertEquals('dark', $response->data[0]['value']);
        $this->assertRequestPath('/settings');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['settingsUid' => 1, 'key' => 'theme'],
        ]);

        $response = $this->api->agrSite->settings->list(['limit' => 10, 'orderBy' => 'key']);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'settingsUid' => 1,
            'key' => 'theme',
            'value' => 'dark',
            'description' => 'Site theme setting',
        ]);

        $response = $this->api->agrSite->settings->get(1);

        $this->assertEquals(1, $response->data['settingsUid']);
        $this->assertEquals('theme', $response->data['key']);
        $this->assertEquals('dark', $response->data['value']);
        $this->assertRequestPath('/settings/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'settingsUid' => 3,
            'key' => 'new_setting',
            'value' => 'new_value',
        ]);

        $response = $this->api->agrSite->settings->create([
            'key' => 'new_setting',
            'value' => 'new_value',
            'description' => 'A new setting',
        ]);

        $this->assertEquals(3, $response->data['settingsUid']);
        $this->assertEquals('new_setting', $response->data['key']);
        $this->assertRequestPath('/settings');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'settingsUid' => 1,
            'key' => 'theme',
            'value' => 'light',
        ]);

        $response = $this->api->agrSite->settings->update(1, ['value' => 'light']);

        $this->assertEquals('light', $response->data['value']);
        $this->assertRequestPath('/settings/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->agrSite->settings->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/settings/1');
        $this->assertRequestMethod('DELETE');
    }
}
