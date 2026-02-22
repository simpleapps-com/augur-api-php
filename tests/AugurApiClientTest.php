<?php

declare(strict_types=1);

namespace AugurApi\Tests;

use AugurApi\AugurApiClient;
use AugurApi\Core\Config;
use AugurApi\Services\AgrInfo\AgrInfoClient;
use AugurApi\Services\AgrSite\AgrSiteClient;
use AugurApi\Services\AgrWork\AgrWorkClient;
use AugurApi\Services\Avalara\AvalaraClient;
use AugurApi\Services\Basecamp2\Basecamp2Client;
use AugurApi\Services\BrandFolder\BrandFolderClient;
use AugurApi\Services\Commerce\CommerceClient;
use AugurApi\Services\Customers\CustomersClient;
use AugurApi\Services\Gregorovich\GregorovichClient;
use AugurApi\Services\Items\ItemsClient;
use AugurApi\Services\Joomla\JoomlaClient;
use AugurApi\Services\Legacy\LegacyClient;
use AugurApi\Services\Logistics\LogisticsClient;
use AugurApi\Services\Nexus\NexusClient;
use AugurApi\Services\OpenSearch\OpenSearchClient;
use AugurApi\Services\Orders\OrdersClient;
use AugurApi\Services\P21Apis\P21ApisClient;
use AugurApi\Services\P21Core\P21CoreClient;
use AugurApi\Services\P21Pim\P21PimClient;
use AugurApi\Services\P21Sism\P21SismClient;
use AugurApi\Services\Payments\PaymentsClient;
use AugurApi\Services\Pricing\PricingClient;
use AugurApi\Services\Shipping\ShippingClient;
use AugurApi\Services\Slack\SlackClient;
use AugurApi\Services\SmartyStreets\SmartyStreetsClient;
use AugurApi\Services\Ups\UpsClient;
use AugurApi\Services\Vmi\VmiClient;
use Http\Mock\Client as MockClient;
use Nyholm\Psr7\Factory\Psr17Factory;

final class AugurApiClientTest extends AugurApiTestCase
{
    public function testConstructorWithAllOptions(): void
    {
        $mockClient = new MockClient();
        $factory = new Psr17Factory();

        $api = new AugurApiClient(
            siteId: 'MY-SITE-ID',
            bearerToken: 'my-secret-token',
            timeout: 60000,
            retries: 5,
            retryDelay: 2000,
            baseUrls: ['items' => 'https://custom.example.com'],
            httpClient: $mockClient,
            requestFactory: $factory,
            streamFactory: $factory,
        );

        $config = $api->getConfig();
        $this->assertEquals('MY-SITE-ID', $config->siteId);
        $this->assertEquals('my-secret-token', $config->bearerToken);
        $this->assertEquals(60000, $config->timeout);
        $this->assertEquals(5, $config->retries);
        $this->assertEquals(2000, $config->retryDelay);
        $this->assertEquals('https://custom.example.com', $config->getBaseUrl('items'));
    }

    public function testConstructorWithMinimalOptions(): void
    {
        $mockClient = new MockClient();
        $factory = new Psr17Factory();

        $api = new AugurApiClient(
            siteId: 'SITE123',
            bearerToken: 'token',
            httpClient: $mockClient,
            requestFactory: $factory,
            streamFactory: $factory,
        );

        $config = $api->getConfig();
        $this->assertEquals('SITE123', $config->siteId);
        $this->assertEquals('token', $config->bearerToken);
        $this->assertEquals(30000, $config->timeout);
        $this->assertEquals(3, $config->retries);
        $this->assertEquals(1000, $config->retryDelay);
    }

    public function testVersionConstant(): void
    {
        $this->assertEquals('0.9.2', AugurApiClient::VERSION);
    }

    public function testVersionConstantIsString(): void
    {
        $reflection = new \ReflectionClass(AugurApiClient::class);
        $constant = $reflection->getReflectionConstant('VERSION');

        $this->assertNotFalse($constant);
        $this->assertTrue($constant->isPublic());
        $this->assertIsString($constant->getValue());
    }

    public function testGetConfigReturnsConfig(): void
    {
        $config = $this->api->getConfig();

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('TEST123', $config->siteId);
    }

    public function testAgrInfoServiceAccessible(): void
    {
        $service = $this->api->agrInfo;

        $this->assertInstanceOf(AgrInfoClient::class, $service);
    }

    public function testAgrSiteServiceAccessible(): void
    {
        $service = $this->api->agrSite;

        $this->assertInstanceOf(AgrSiteClient::class, $service);
    }

    public function testAgrWorkServiceAccessible(): void
    {
        $service = $this->api->agrWork;

        $this->assertInstanceOf(AgrWorkClient::class, $service);
    }

    public function testAvalaraServiceAccessible(): void
    {
        $service = $this->api->avalara;

        $this->assertInstanceOf(AvalaraClient::class, $service);
    }

    public function testBasecamp2ServiceAccessible(): void
    {
        $service = $this->api->basecamp2;

        $this->assertInstanceOf(Basecamp2Client::class, $service);
    }

    public function testBrandFolderServiceAccessible(): void
    {
        $service = $this->api->brandFolder;

        $this->assertInstanceOf(BrandFolderClient::class, $service);
    }

    public function testCommerceServiceAccessible(): void
    {
        $service = $this->api->commerce;

        $this->assertInstanceOf(CommerceClient::class, $service);
    }

    public function testCustomersServiceAccessible(): void
    {
        $service = $this->api->customers;

        $this->assertInstanceOf(CustomersClient::class, $service);
    }

    public function testGregorovichServiceAccessible(): void
    {
        $service = $this->api->gregorovich;

        $this->assertInstanceOf(GregorovichClient::class, $service);
    }

    public function testItemsServiceAccessible(): void
    {
        $service = $this->api->items;

        $this->assertInstanceOf(ItemsClient::class, $service);
    }

    public function testJoomlaServiceAccessible(): void
    {
        $service = $this->api->joomla;

        $this->assertInstanceOf(JoomlaClient::class, $service);
    }

    public function testLegacyServiceAccessible(): void
    {
        $service = $this->api->legacy;

        $this->assertInstanceOf(LegacyClient::class, $service);
    }

    public function testLogisticsServiceAccessible(): void
    {
        $service = $this->api->logistics;

        $this->assertInstanceOf(LogisticsClient::class, $service);
    }

    public function testNexusServiceAccessible(): void
    {
        $service = $this->api->nexus;

        $this->assertInstanceOf(NexusClient::class, $service);
    }

    public function testOpenSearchServiceAccessible(): void
    {
        $service = $this->api->openSearch;

        $this->assertInstanceOf(OpenSearchClient::class, $service);
    }

    public function testOrdersServiceAccessible(): void
    {
        $service = $this->api->orders;

        $this->assertInstanceOf(OrdersClient::class, $service);
    }

    public function testP21ApisServiceAccessible(): void
    {
        $service = $this->api->p21Apis;

        $this->assertInstanceOf(P21ApisClient::class, $service);
    }

    public function testP21CoreServiceAccessible(): void
    {
        $service = $this->api->p21Core;

        $this->assertInstanceOf(P21CoreClient::class, $service);
    }

    public function testP21PimServiceAccessible(): void
    {
        $service = $this->api->p21Pim;

        $this->assertInstanceOf(P21PimClient::class, $service);
    }

    public function testP21SismServiceAccessible(): void
    {
        $service = $this->api->p21Sism;

        $this->assertInstanceOf(P21SismClient::class, $service);
    }

    public function testPaymentsServiceAccessible(): void
    {
        $service = $this->api->payments;

        $this->assertInstanceOf(PaymentsClient::class, $service);
    }

    public function testPricingServiceAccessible(): void
    {
        $service = $this->api->pricing;

        $this->assertInstanceOf(PricingClient::class, $service);
    }

    public function testShippingServiceAccessible(): void
    {
        $service = $this->api->shipping;

        $this->assertInstanceOf(ShippingClient::class, $service);
    }

    public function testSlackServiceAccessible(): void
    {
        $service = $this->api->slack;

        $this->assertInstanceOf(SlackClient::class, $service);
    }

    public function testSmartyStreetsServiceAccessible(): void
    {
        $service = $this->api->smartyStreets;

        $this->assertInstanceOf(SmartyStreetsClient::class, $service);
    }

    public function testUpsServiceAccessible(): void
    {
        $service = $this->api->ups;

        $this->assertInstanceOf(UpsClient::class, $service);
    }

    public function testVmiServiceAccessible(): void
    {
        $service = $this->api->vmi;

        $this->assertInstanceOf(VmiClient::class, $service);
    }

    public function testAll27ServicesAccessible(): void
    {
        $services = [
            'agrInfo' => AgrInfoClient::class,
            'agrSite' => AgrSiteClient::class,
            'agrWork' => AgrWorkClient::class,
            'avalara' => AvalaraClient::class,
            'basecamp2' => Basecamp2Client::class,
            'brandFolder' => BrandFolderClient::class,
            'commerce' => CommerceClient::class,
            'customers' => CustomersClient::class,
            'gregorovich' => GregorovichClient::class,
            'items' => ItemsClient::class,
            'joomla' => JoomlaClient::class,
            'legacy' => LegacyClient::class,
            'logistics' => LogisticsClient::class,
            'nexus' => NexusClient::class,
            'openSearch' => OpenSearchClient::class,
            'orders' => OrdersClient::class,
            'p21Apis' => P21ApisClient::class,
            'p21Core' => P21CoreClient::class,
            'p21Pim' => P21PimClient::class,
            'p21Sism' => P21SismClient::class,
            'payments' => PaymentsClient::class,
            'pricing' => PricingClient::class,
            'shipping' => ShippingClient::class,
            'slack' => SlackClient::class,
            'smartyStreets' => SmartyStreetsClient::class,
            'ups' => UpsClient::class,
            'vmi' => VmiClient::class,
        ];

        $this->assertCount(27, $services);

        foreach ($services as $name => $expectedClass) {
            $service = $this->api->$name;
            $this->assertInstanceOf($expectedClass, $service, "Service {$name} is not of type {$expectedClass}");
        }
    }

    public function testServiceLazyLoading(): void
    {
        $reflection = new \ReflectionClass($this->api);
        $property = $reflection->getProperty('services');

        $servicesBefore = $property->getValue($this->api);
        $this->assertEmpty($servicesBefore);

        $items = $this->api->items;
        $this->assertNotNull($items);
        $servicesAfter = $property->getValue($this->api);
        $this->assertArrayHasKey('items', $servicesAfter);
    }

    public function testServiceCaching(): void
    {
        $items1 = $this->api->items;
        $items2 = $this->api->items;

        $this->assertSame($items1, $items2);
    }

    public function testUnknownServiceThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown service: unknownService');

        /** @phpstan-ignore-next-line Testing unknown property access */
        $_ = $this->api->unknownService;
    }

    public function testClassIsFinal(): void
    {
        $reflection = new \ReflectionClass(AugurApiClient::class);

        $this->assertTrue($reflection->isFinal());
    }

    public function testCustomBaseUrlsPassedToConfig(): void
    {
        $mockClient = new MockClient();
        $factory = new Psr17Factory();

        $api = new AugurApiClient(
            siteId: 'SITE123',
            bearerToken: 'token',
            baseUrls: [
                'items' => 'https://items.custom.com',
                'orders' => 'https://orders.custom.com',
            ],
            httpClient: $mockClient,
            requestFactory: $factory,
            streamFactory: $factory,
        );

        $config = $api->getConfig();
        $this->assertEquals('https://items.custom.com', $config->getBaseUrl('items'));
        $this->assertEquals('https://orders.custom.com', $config->getBaseUrl('orders'));
        $this->assertEquals('https://customers.augur-api.com', $config->getBaseUrl('customers'));
    }
}
