<?php

namespace App\Models\Repositories;

use App\Exceptions\LinkRepositoryMongoException;
use App\Models\Repositories\Interfaces\LinkRepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class LinkRepositoryMongo implements LinkRepositoryInterface
{
    protected const TABLE = 'links';

    public function store(array $store){
        $res = DB::connection('mongodb')->collection('LinkMinifier')
            ->insert($store);
        if(!$res)
            throw new LinkRepositoryMongoException('Error db insertion');

        return $res;
    }

    public function getByShortKey(string $shortKey)
    {
        $res = DB::connection('mongodb')->collection('LinkMinifier')
            ->select('*')
            ->where('short_key', '=', $shortKey)
            ->first();
        if(!$res)
            throw new LinkRepositoryMongoException('Row with such key does not exist');

        return (object)$res;
    }
}
