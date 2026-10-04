<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * notifications resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-site.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-site.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-site.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * NotificationsCreateData:
 * Returned by: $api->agrSite->notifications->create($data)
 *   notificationsUid: int — Notification ID
 *   serviceName: string|null — Service the notification is about (max 100 chars)
 *   dataTypeName: string|null — Datatype the notification is about (max 100 chars)
 *   type: string|null — Notification type (max 100 chars)
 *   dataTypeUid: int — ID of the record the notification is about
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * NotificationsCreateBody: Record a notification, or return the existing one with the same key
 * Request body of: $api->agrSite->notifications->create($data)
 *   serviceName: string|null — Service the notification is about; nothing is stored when missing
 *   dataTypeName: string|null — Datatype the notification is about; nothing is stored when missing
 *   type: string|null — Notification type; nothing is stored when missing
 *   dataTypeUid?: int|null — ID of the record the notification is about (Default: 0)
 *
 * @phpstan-type NotificationsCreateData array{notificationsUid: int, serviceName: string|null, dataTypeName: string|null, type: string|null, dataTypeUid: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type NotificationsCreateBody array{serviceName: string|null, dataTypeName: string|null, type: string|null, dataTypeUid?: int|null}
 */
final class NotificationsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /notifications
     *
     * Create Notification
     * Call: $api->agrSite->notifications->create($data)
     *
     * Request body: Record a notification, or return the existing one with the same key
     *
     * Errors:
     *   400: The body is missing or not valid JSON.
     *
     * POST https://agr-site.augur-api.com/notifications
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1notifications/post
     *
     * Request body ($data): NotificationsCreateBody (fields listed on the class)
     *
     * Response data type: NotificationsCreateData (fields listed on the class)
     *
     * @param NotificationsCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
