<?php

declare(strict_types=1);

namespace App\Models;

use MongoDB\Collection;
use MongoDB\Client;

abstract class BaseModel
{
    protected Client $mongo_client;
    protected string $collection_name;

    public function __construct(Client $mongo_client)
    {
        $this->mongo_client = $mongo_client;
        $this->collection_name = $this->getCollectionName();
    }

    abstract protected function getCollectionName(): string;

    protected function getCollection(): Collection
    {
        return $this->mongo_client->pokedex->{$this->collection_name};
    }

    public function find(array $filter = [], array $options = []): array
    {
        return $this->getCollection()->find($filter, $options)->toArray();
    }

    public function findOne(array $filter = [], array $options = []): ?array
    {
        return $this->getCollection()->findOne($filter, $options)?->getArrayCopy();
    }

    public function insert(array $document): void
    {
        $this->getCollection()->insertOne($document);
    }

    public function update(array $filter, array $update, array $options = []): void
    {
        $this->getCollection()->updateOne($filter, ['$set' => $update], $options);
    }

    public function delete(array $filter, array $options = []): void
    {
        $this->getCollection()->deleteOne($filter, $options);
    }
}
