<?php

namespace App\Http\Services\Interfaces;

use Illuminate\Database\Query\Builder;

interface LinkServiceInterface
{
    public function getByShortKey(string $shortKey);
    public function store(array $store);
}
