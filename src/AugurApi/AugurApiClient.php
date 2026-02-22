<?php

declare(strict_types=1);

namespace AugurApi;

use AugurApi\Core\Client;
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
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Augur API Client.
 *
 * Main entry point for all Augur API services.
 *
 * @property-read AgrInfoClient $agrInfo
 * @property-read AgrSiteClient $agrSite
 * @property-read AgrWorkClient $agrWork
 * @property-read AvalaraClient $avalara
 * @property-read Basecamp2Client $basecamp2
 * @property-read BrandFolderClient $brandFolder
 * @property-read CommerceClient $commerce
 * @property-read CustomersClient $customers
 * @property-read GregorovichClient $gregorovich
 * @property-read ItemsClient $items
 * @property-read JoomlaClient $joomla
 * @property-read LegacyClient $legacy
 * @property-read LogisticsClient $logistics
 * @property-read NexusClient $nexus
 * @property-read OpenSearchClient $openSearch
 * @property-read OrdersClient $orders
 * @property-read P21ApisClient $p21Apis
 * @property-read P21CoreClient $p21Core
 * @property-read P21PimClient $p21Pim
 * @property-read P21SismClient $p21Sism
 * @property-read PaymentsClient $payments
 * @property-read PricingClient $pricing
 * @property-read ShippingClient $shipping
 * @property-read SlackClient $slack
 * @property-read SmartyStreetsClient $smartyStreets
 * @property-read UpsClient $ups
 * @property-read VmiClient $vmi
 */
final class AugurApiClient
{
    public const string VERSION = '0.9.1';

    private readonly Config $config;
    private readonly Client $client;

    /** @var array<string, object> Lazy-loaded service clients */
    private array $services = [];

    /**
     * @param array<string, string> $baseUrls Override default service URLs
     */
    public function __construct(
        string $siteId,
        string $bearerToken,
        int $timeout = 30000,
        int $retries = 3,
        int $retryDelay = 1000,
        array $baseUrls = [],
        ?ClientInterface $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
    ) {
        $this->config = new Config(
            $siteId,
            $bearerToken,
            $timeout,
            $retries,
            $retryDelay,
            $baseUrls,
        );

        $this->client = new Client(
            $this->config,
            $httpClient,
            $requestFactory,
            $streamFactory,
        );
    }

    public function __get(string $name): object
    {
        return $this->services[$name] ??= $this->createService($name);
    }

    private function createService(string $name): object
    {
        return match ($name) {
            'agrInfo' => new AgrInfoClient($this->client, $this->config),
            'agrSite' => new AgrSiteClient($this->client, $this->config),
            'agrWork' => new AgrWorkClient($this->client, $this->config),
            'avalara' => new AvalaraClient($this->client, $this->config),
            'basecamp2' => new Basecamp2Client($this->client, $this->config),
            'brandFolder' => new BrandFolderClient($this->client, $this->config),
            'commerce' => new CommerceClient($this->client, $this->config),
            'customers' => new CustomersClient($this->client, $this->config),
            'gregorovich' => new GregorovichClient($this->client, $this->config),
            'items' => new ItemsClient($this->client, $this->config),
            'joomla' => new JoomlaClient($this->client, $this->config),
            'legacy' => new LegacyClient($this->client, $this->config),
            'logistics' => new LogisticsClient($this->client, $this->config),
            'nexus' => new NexusClient($this->client, $this->config),
            'openSearch' => new OpenSearchClient($this->client, $this->config),
            'orders' => new OrdersClient($this->client, $this->config),
            'p21Apis' => new P21ApisClient($this->client, $this->config),
            'p21Core' => new P21CoreClient($this->client, $this->config),
            'p21Pim' => new P21PimClient($this->client, $this->config),
            'p21Sism' => new P21SismClient($this->client, $this->config),
            'payments' => new PaymentsClient($this->client, $this->config),
            'pricing' => new PricingClient($this->client, $this->config),
            'shipping' => new ShippingClient($this->client, $this->config),
            'slack' => new SlackClient($this->client, $this->config),
            'smartyStreets' => new SmartyStreetsClient($this->client, $this->config),
            'ups' => new UpsClient($this->client, $this->config),
            'vmi' => new VmiClient($this->client, $this->config),
            default => throw new \InvalidArgumentException("Unknown service: {$name}"),
        };
    }

    public function getConfig(): Config
    {
        return $this->config;
    }
}
