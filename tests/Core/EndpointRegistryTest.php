<?php

declare(strict_types=1);

namespace AugurApi\Tests\Core;

use AugurApi\AugurApiClient;
use AugurApi\Core\EndpointEntry;
use AugurApi\Core\Registry;
use AugurApi\Tests\AugurApiTestCase;

final class EndpointRegistryTest extends AugurApiTestCase
{
    /**
     * @return array{registryVersion: int, fields: list<string>, optionalFields: list<string>}
     */
    private static function contract(): array
    {
        /** @var array{registryVersion: int, fields: list<string>, optionalFields: list<string>} */
        return json_decode(
            (string) file_get_contents(__DIR__ . '/../fixtures/registry-contract.json'),
            true,
            flags: JSON_THROW_ON_ERROR,
        );
    }

    public function testEndpointsMatchRegistryJson(): void
    {
        $expected = json_decode(
            (string) file_get_contents(__DIR__ . '/../../src/AugurApi/Core/registry.json'),
            true,
            flags: JSON_THROW_ON_ERROR,
        );
        $actual = array_map(
            static fn (EndpointEntry $entry): array => $entry->toArray(),
            AugurApiClient::endpoints(),
        );

        $this->assertNotEmpty($actual);
        $this->assertSame($expected, $actual);
    }

    public function testEndpointsAreCached(): void
    {
        $this->assertSame(Registry::entries(), AugurApiClient::endpoints());
    }

    public function testKeysMatchContractFields(): void
    {
        $contract = self::contract();

        foreach (AugurApiClient::endpoints() as $entry) {
            $keys = array_keys($entry->toArray());
            $this->assertSame($contract['fields'], $keys, $entry->id);
            $this->assertNull($entry->readOnly, $entry->id);
        }
        $this->assertSame(['readOnly'], $contract['optionalFields']);
    }

    public function testRegistryVersionMatchesContract(): void
    {
        $this->assertSame(self::contract()['registryVersion'], AugurApiClient::REGISTRY_VERSION);
    }

    public function testIdsAreUniqueAndAliasesDoNotCollide(): void
    {
        $ids = array_map(static fn (EndpointEntry $entry): string => $entry->id, AugurApiClient::endpoints());
        $this->assertSame(count($ids), count(array_unique($ids)));

        $canonical = array_flip($ids);
        foreach (AugurApiClient::endpoints() as $entry) {
            $root = substr($entry->id, 0, (int) strrpos($entry->id, '.'));
            foreach ($entry->aliases as $alias) {
                $this->assertArrayNotHasKey($root . '.' . $alias, $canonical, $entry->id);
            }
        }
    }

    public function testEveryIdRootIsAClientService(): void
    {
        $roots = [];
        foreach (AugurApiClient::endpoints() as $entry) {
            $roots[explode('.', $entry->id)[0]] = true;
        }

        $this->assertCount(26, $roots);
        $this->assertArrayHasKey('openSearch', $roots);
        foreach (array_keys($roots) as $root) {
            $this->assertIsObject($this->api->{$root}, $root);
        }
    }

    public function testToArrayRoundTripsWithReadOnly(): void
    {
        $data = [
            'id' => 'openSearch.itemSearch.list',
            'service' => 'open-search',
            'method' => 'POST',
            'path' => '/item-search/{itemId}',
            'pathParams' => ['itemId'],
            'queryParams' => ['q'],
            'aliases' => ['search'],
            'hasBody' => true,
            'auth' => 'bearer',
            'edgeCache' => false,
            'readOnly' => true,
        ];

        $entry = EndpointEntry::fromArray($data);

        $this->assertTrue($entry->readOnly);
        $this->assertSame($data, $entry->toArray());
        $this->assertSame(
            [...self::contract()['fields'], 'readOnly'],
            array_keys($entry->toArray()),
        );
    }
}
