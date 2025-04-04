<?php

declare(strict_types=1);

namespace App\Controllers;

use MongoDB\Client;
use App\Helpers\View;

abstract class AbstractController
{
    protected Client $mongo_client;
    protected array $query_params = [];
    protected View $view;

    public function __construct(Client $mongo_client)
    {
        $this->mongo_client = $mongo_client;
        $this->view = new View();
    }

    public function setQueryParams(array $query_params): void
    {
        $this->query_params = $query_params;
    }

    protected function getQueryParams(): array
    {
        return $this->query_params;
    }

    protected function render(string $view, array $data = []): string
    {
        return $this->view->render($view, $data);
    }
}
