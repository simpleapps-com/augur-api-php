<?php

declare(strict_types=1);

namespace AugurApi\Services\BrandFolder;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\BrandFolder\Resources\CategoriesResource;

/**
 * BrandFolder service client.
 *
 * @fullPath api.brandFolder
 * @service brand_folder
 * @domain digital-assets
 */
final class BrandFolderClient extends BaseServiceClient
{
    public readonly CategoriesResource $categories;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->categories = new CategoriesResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'brandFolder';
    }
}
