<?php

declare(strict_types=1);

namespace AugurApi\Core;

/**
 * Configuration for the Augur API client.
 */
final readonly class Config
{
    /** @var array<string, string> */
    private array $baseUrls;

    /**
     * @param array<string, string> $baseUrls Override default service URLs
     */
    public function __construct(
        public string $siteId,
        public string $bearerToken,
        public int $timeout = 30000,
        public int $retries = 3,
        public int $retryDelay = 1000,
        array $baseUrls = [],
    ) {
        $this->baseUrls = [...$this->getDefaultBaseUrls(), ...$baseUrls];
    }

    public function getBaseUrl(string $service): string
    {
        return $this->baseUrls[$service] ?? $this->getDefaultBaseUrl($service);
    }

    /**
     * @return array<string, string>
     */
    private function getDefaultBaseUrls(): array
    {
        return [
            'items' => 'https://items.augur-api.com',
            'customers' => 'https://customers.augur-api.com',
            'orders' => 'https://orders.augur-api.com',
            'commerce' => 'https://commerce.augur-api.com',
            'pricing' => 'https://pricing.augur-api.com',
            'payments' => 'https://payments.augur-api.com',
            'joomla' => 'https://joomla.augur-api.com',
            'brandFolder' => 'https://brand-folder.augur-api.com',
            'openSearch' => 'https://open-search.augur-api.com',
            'vmi' => 'https://vmi.augur-api.com',
            'nexus' => 'https://nexus.augur-api.com',
            'logistics' => 'https://logistics.augur-api.com',
            'shipping' => 'https://shipping.augur-api.com',
            'ups' => 'https://ups.augur-api.com',
            'avalara' => 'https://avalara.augur-api.com',
            'slack' => 'https://slack.augur-api.com',
            'smartyStreets' => 'https://smarty-streets.augur-api.com',
            'gregorovich' => 'https://gregorovich.augur-api.com',
            'legacy' => 'https://legacy.augur-api.com',
            'basecamp2' => 'https://basecamp2.augur-api.com',
            'p21Apis' => 'https://p21-apis.augur-api.com',
            'p21Core' => 'https://p21-core.augur-api.com',
            'p21Pim' => 'https://p21-pim.augur-api.com',
            'p21Sism' => 'https://p21-sism.augur-api.com',
            'agrInfo' => 'https://agr-info.augur-api.com',
            'agrSite' => 'https://agr-site.augur-api.com',
            'agrWork' => 'https://agr-work.augur-api.com',
        ];
    }

    private function getDefaultBaseUrl(string $service): string
    {
        $kebabService = strtolower((string) preg_replace('/([a-z])([A-Z])/', '$1-$2', $service));
        return "https://{$kebabService}.augur-api.com";
    }
}
