<?php

declare(strict_types=1);

namespace App\Models;

use MongoDB\Client;

class Pokemon extends BaseModel
{
protected $collection;
protected Client $mongoClient;

protected function getCollectionName(): string
{
return 'pokemon';
}

public function __construct(Client $mongoClient)
{
$this->mongoClient = $mongoClient;
$this->collection = $mongoClient->selectCollection('pokedex', 'pokedex');
}

public function findById($id)
{
$result = $this->collection->findOne(['id' => (int)$id]);

return $result ? json_decode(json_encode($result), true) : null;
}

public function findByType(string $type): array
{
return $this->find(['type' => $type]);
}

public function findByName(string $name): ?array
{
return $this->collection->findOne(['name.english' => $name])?->getArrayCopy() ?? null;
}

public function filterByType($type): array
{
return iterator_to_array($this->collection->find([
'type' => $type
]));
}

public function all(): array
{
return iterator_to_array($this->collection->find());
}
}

// <?php

// declare(strict_types=1);

// namespace App\Models;

// use MongoDB\Client;

// class Pokemon extends BaseModel
// {
// protected $collection;
// protected Client $mongoClient;

// protected function getCollectionName(): string
// {
// return 'pokemon';
// }

// public function __construct(Client $mongoClient)
// {
// $this->mongoClient = $mongoClient;
// $this->collection = $mongoClient->selectCollection('pokedex', 'pokedex');
// }

// public function findById($id)
// {
// $result = $this->collection->findOne(['id' => (int)$id]);

// return $result ? json_decode(json_encode($result), true) : null;
// }


// public function findByName(string $name): ?array
// {
// return $this->collection->findOne(['name.english' => $name])?->getArrayCopy() ?? null;
// }

// public function filterByType($type): array
// {
// return iterator_to_array($this->collection->find([
// 'type' => $type
// ]));
// }

// public function all(): array
// {
// return iterator_to_array($this->collection->find());
// }
// }