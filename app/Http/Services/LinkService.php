<?php

namespace App\Http\Services;

use App\Exceptions\LinkRepositoryException;
use App\Http\LinksHelper;
use App\Http\Services\Interfaces\LinkServiceInterface;
use App\Models\Repositories\Interfaces\LinkRepositoryInterface;
use App\Exceptions\LinkHelperException;

class LinkService implements LinkServiceInterface
{
    protected $linkRepository;

    public function __construct(LinkRepositoryInterface $linkRepository){
        $this->linkRepository = $linkRepository;
    }

    public function getByShortKey(string $shortKey)
    {
        try {
            return $this->linkRepository->getByShortKey($shortKey);
        }
        catch (LinkRepositoryException $e){
             echo $e->getMessage();
             die();
        }
    }

    public function store(array $store)
    {
        try{
            $store['short_key'] = LinksHelper::generateShortKey();

        }
        catch (LinkHelperException $e){
            echo $e->getMessage();
            die();
        }
        try{
            return $this->linkRepository->store($store);
        }
        catch (LinkRepositoryException $e){
            echo $e->getMessage();
            die();
        }
    }

}
