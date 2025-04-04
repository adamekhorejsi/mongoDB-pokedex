<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\BaseModel;

class Item extends BaseModel
{
    protected function getCollectionName(): string
    {
        return 'items';
    }
}
