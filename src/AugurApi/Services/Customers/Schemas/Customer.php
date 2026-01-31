<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Schemas;

/**
 * Customer schema.
 */
final readonly class Customer
{
    /**
     * @param array<string, mixed> $extra Additional fields not explicitly defined
     */
    public function __construct(
        public ?string $customerId = null,
        public ?string $customerName = null,
        public ?string $address1 = null,
        public ?string $address2 = null,
        public ?string $city = null,
        public ?string $state = null,
        public ?string $postalCode = null,
        public ?string $country = null,
        public ?string $phone = null,
        public ?string $email = null,
        public ?string $statusCd = null,
        public array $extra = [],
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $knownKeys = [
            'customerId', 'customerName', 'address1', 'address2', 'city',
            'state', 'postalCode', 'country', 'phone', 'email', 'statusCd',
        ];
        $extra = array_diff_key($data, array_flip($knownKeys));

        return new self(
            customerId: $data['customerId'] ?? null,
            customerName: $data['customerName'] ?? null,
            address1: $data['address1'] ?? null,
            address2: $data['address2'] ?? null,
            city: $data['city'] ?? null,
            state: $data['state'] ?? null,
            postalCode: $data['postalCode'] ?? null,
            country: $data['country'] ?? null,
            phone: $data['phone'] ?? null,
            email: $data['email'] ?? null,
            statusCd: $data['statusCd'] ?? null,
            extra: $extra,
        );
    }
}
