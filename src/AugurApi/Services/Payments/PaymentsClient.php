<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Payments\Resources\ElementResource;
use AugurApi\Services\Payments\Resources\MonerisResource;
use AugurApi\Services\Payments\Resources\PaytraceResource;
use AugurApi\Services\Payments\Resources\UnifiedResource;

/**
 * Payments service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py payments
 */
final class PaymentsClient extends BaseServiceClient
{
    public readonly ElementResource $element;
    public readonly MonerisResource $moneris;
    public readonly PaytraceResource $paytrace;
    public readonly UnifiedResource $unified;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->element = new ElementResource($client, $this->baseUrl . '/element');
        $this->moneris = new MonerisResource($client, $this->baseUrl . '/moneris');
        $this->paytrace = new PaytraceResource($client, $this->baseUrl . '/paytrace');
        $this->unified = new UnifiedResource($client, $this->baseUrl . '/unified');
    }

    protected function getServiceName(): string
    {
        return 'payments';
    }
}
