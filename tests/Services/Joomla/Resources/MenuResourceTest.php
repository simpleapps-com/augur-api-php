<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Joomla\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for MenuResource.
 */
final class MenuResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'title' => 'Home', 'menutype' => 'mainmenu', 'published' => 1],
            ['id' => 2, 'title' => 'About', 'menutype' => 'mainmenu', 'published' => 1],
        ]);

        $response = $this->api->joomla->menu->list();

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Home', $data[0]['title']);
        $this->assertRequestPath('/menu');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'title' => 'Home', 'menutype' => 'mainmenu', 'published' => 1],
        ]);

        $response = $this->api->joomla->menu->list(['menutype' => 'mainmenu', 'published' => 1]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/menu');
    }

    public function testListDoc(): void
    {
        $this->mockResponse([
            'id' => 1,
            'title' => 'Main Menu',
            'menutype' => 'mainmenu',
            'link' => 'index.php',
        ]);

        $response = $this->api->joomla->menu->listDoc(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertRequestPath('/menu/1/doc');
        $this->assertRequestMethod('GET');
    }

    public function testGetDocAlias(): void
    {
        $this->mockResponse([
            'id' => 1,
            'title' => 'Main Menu',
            'menutype' => 'mainmenu',
            'link' => 'index.php',
            'type' => 'component',
        ]);

        $response = $this->api->joomla->menu->getDoc(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertEquals('Main Menu', $response->data['title']);
        $this->assertRequestPath('/menu/1/doc');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
