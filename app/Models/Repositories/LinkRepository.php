<?php

namespace App\Models\Repositories;

use App\Exceptions\LinkRepositoryException;
use App\Models\Repositories\Interfaces\LinkRepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class LinkRepository implements LinkRepositoryInterface
{
    protected const TABLE = 'links';

    public function store(array $store){
        $res = DB::table(self::TABLE)
            ->insert($store);
        if(!$res)
            throw new LinkRepositoryException('Error db insertion');

        return $res;
    }

    public function getByShortKey(string $shortKey)
    {
        $res = DB::table(self::TABLE)
            ->select('*')
            ->where('short_key', '=', $shortKey)
            ->first();
        if(!$res)
            throw new LinkRepositoryException('Row with such key does not exist');

        return $res;
    }
}
