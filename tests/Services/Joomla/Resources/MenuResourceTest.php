<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Joomla\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for MenuResource.
 */
final class MenuResourceTest extends AugurApiTestCase
{
    public function testGetDoc(): void
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
        $this->assertEquals('mainmenu', $response->data['menutype']);
        $this->assertRequestPath('/menu/1/doc');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
