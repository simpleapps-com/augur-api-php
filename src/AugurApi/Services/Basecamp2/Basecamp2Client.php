<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Basecamp2\Resources\CommentsResource;
use AugurApi\Services\Basecamp2\Resources\EventsResource;
use AugurApi\Services\Basecamp2\Resources\MetricsResource;
use AugurApi\Services\Basecamp2\Resources\PeopleResource;
use AugurApi\Services\Basecamp2\Resources\ProjectsResource;
use AugurApi\Services\Basecamp2\Resources\TodolistsResource;
use AugurApi\Services\Basecamp2\Resources\TodosResource;
use AugurApi\Services\Basecamp2\Resources\TodosSummaryResource;

/**
 * Basecamp2 service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py basecamp2
 */
final class Basecamp2Client extends BaseServiceClient
{
    public readonly CommentsResource $comments;
    public readonly EventsResource $events;
    public readonly MetricsResource $metrics;
    public readonly PeopleResource $people;
    public readonly ProjectsResource $projects;
    public readonly TodolistsResource $todolists;
    public readonly TodosResource $todos;
    public readonly TodosSummaryResource $todosSummary;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->comments = new CommentsResource($client, $this->baseUrl . '/comments');
        $this->events = new EventsResource($client, $this->baseUrl . '/events');
        $this->metrics = new MetricsResource($client, $this->baseUrl . '/metrics');
        $this->people = new PeopleResource($client, $this->baseUrl . '/people');
        $this->projects = new ProjectsResource($client, $this->baseUrl . '/projects');
        $this->todolists = new TodolistsResource($client, $this->baseUrl . '/todolists');
        $this->todos = new TodosResource($client, $this->baseUrl . '/todos');
        $this->todosSummary = new TodosSummaryResource($client, $this->baseUrl . '/todos-summary');
    }

    protected function getServiceName(): string
    {
        return 'basecamp2';
    }
}
