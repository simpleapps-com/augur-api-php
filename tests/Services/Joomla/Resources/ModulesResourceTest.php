<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Joomla\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ModulesResource.
 */
final class ModulesResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'title' => 'Main Menu', 'position' => 'sidebar', 'module' => 'mod_menu'],
            ['id' => 2, 'title' => 'Footer', 'position' => 'footer', 'module' => 'mod_custom'],
        ]);

        $response = $this->api->joomla->modules->list();

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Main Menu', $data[0]['title']);
        $this->assertRequestPath('/modules');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'title' => 'Main Menu', 'position' => 'sidebar', 'module' => 'mod_menu'],
        ]);

        $response = $this->api->joomla->modules->list(['position' => 'sidebar', 'menuId' => 101]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/modules');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'id' => 1,
            'title' => 'Main Menu',
            'position' => 'sidebar',
            'module' => 'mod_menu',
        ]);

        $response = $this->api->joomla->modules->get(1, ['normalize' => true]);

        $this->assertEquals(1, $response->data['id']);
        $this->assertEquals('mod_menu', $response->data['module']);
        $this->assertRequestPath('/modules/1');
        $this->assertRequestMethod('GET');
    }
}
