<?php

namespace App\Http\Services;

use App\Enums\DictionaryEnum;
use App\Exceptions\LinkRepositoryException;
use App\Http\Services\Interfaces\LinkServiceInterface;
use App\Models\Repositories\Interfaces\LinkRepositoryInterface;
use Illuminate\Database\Query\Builder;
use App\Exceptions\LinkServiceException;

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
            dd($e->getMessage());
        }
    }

    public function store(array $store)
    {
        try{
            $store['short_key'] = $this->generateShortKey();
            dump(env("APP_URL").'/'.$store['short_key']);
        }
        catch (LinkServiceException $e){
            dd($e->getMessage());
        }
        try{
            return $this->linkRepository->store($store);
        }
        catch (LinkRepositoryException $e){
            dd($e->getMessage());
        }
    }

    protected function generateShortKey(): string
    {
        $time = time();
        $key = '';
        $mt = explode(' ',microtime());
        $mt = explode('.',$mt[0]);
        $mt = str_split($mt[1], 2);
        $time .= $mt[0];
        foreach (str_split($time, 2) as $item){
            if(!isset(DictionaryEnum::DICTIONARY[$item]))
                throw new LinkServiceException("Error generating short key");
            $key .= DictionaryEnum::DICTIONARY[$item];
        }
        return $key;
    }

}
