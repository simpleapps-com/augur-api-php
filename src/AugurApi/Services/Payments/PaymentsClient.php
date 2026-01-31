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
 * Payments service client.
 *
 * @fullPath api.payments
 * @service payments
 * @domain payments
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
        $this->element = new ElementResource($client, $this->baseUrl);
        $this->moneris = new MonerisResource($client, $this->baseUrl);
        $this->paytrace = new PaytraceResource($client, $this->baseUrl);
        $this->unified = new UnifiedResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'payments';
    }
}
