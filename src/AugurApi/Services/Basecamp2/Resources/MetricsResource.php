<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * metrics resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py basecamp2
 */
final class MetricsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /metrics
     *
     * Response data type: array
     *   id: int
     *   projectsId: int|null
     *   todolistId: int|null
     *   assigneeId: int|null
     *   creatorId: int
     *   todosContent: string|null
     *   todosStatusCd: int
     *   isStale: int
     *   hasComments: int
     *   needsResponse: int
     *   createdAt: string
     *   completedAt: string|null
     *   lastActivityAt: string
     *   firstCommentAt: string|null
     *   lastCommentAt: string|null
     *   daysOpen: int|null
     *   daysSinceLastEvent: int|null
     *   daysToFirstComment: int|null
     *   cycleTimeDays: int|null
     *   commentCount: int
     *   activeDaysCount: int
     *   activitySpanDays: int|null
     *   avgDaysBetweenActivity: float|null
     *   lastCommenterId: int|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
