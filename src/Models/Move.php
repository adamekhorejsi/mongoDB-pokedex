<?php

declare(strict_types=1);

namespace App\Models;

class Move extends BaseModel
{
    protected function getCollectionName(): string
    {
        return 'move';
    }
    public function findByTypes(array $types): array
    {
        return $this->mongo_client->pokedex->moves->find(['type' => ['$in' => $types]])->toArray();
    }
    
}
