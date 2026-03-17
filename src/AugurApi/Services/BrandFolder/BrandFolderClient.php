<?php

declare(strict_types=1);

namespace AugurApi\Services\BrandFolder;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\BrandFolder\Resources\CategoriesResource;

/**
 * BrandFolder service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py brand-folder
 */
final class BrandFolderClient extends BaseServiceClient
{
    public readonly CategoriesResource $categories;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->categories = new CategoriesResource($client, $this->baseUrl . '/categories');
    }

    protected function getServiceName(): string
    {
        return 'brandFolder';
    }
}
