<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrSite\Resources;

use AugurApi\Tests\AugurApiTestCase;
use Nyholm\Psr7\Response;

/**
 * Tests for MetaFilesResource.
 */
final class MetaFilesResourceTest extends AugurApiTestCase
{
    public function testGetRobots(): void
    {
        $robotsContent = "User-agent: *\nDisallow: /admin/\nAllow: /";

        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => $robotsContent,
                'status' => 200,
            ])),
        );

        $response = $this->api->agrSite->metaFiles->getRobots();

        $this->assertEquals($robotsContent, $response->data);
        $this->assertRequestPath('/meta-files/robots');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGetRobotsEmptyContent(): void
    {
        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => '',
                'status' => 200,
            ])),
        );

        $response = $this->api->agrSite->metaFiles->getRobots();

        $this->assertEquals('', $response->data);
    }
}
