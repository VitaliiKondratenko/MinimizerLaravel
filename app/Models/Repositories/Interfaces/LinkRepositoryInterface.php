<?php

namespace App\Models\Repositories\Interfaces;

use Illuminate\Database\Query\Builder;

interface LinkRepositoryInterface
{
    public function store(array $store);
    public function getByShortKey(string $shortKey);
}
