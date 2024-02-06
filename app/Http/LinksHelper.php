<?php

namespace App\Http;

use App\Enums\DictionaryEnum;
use App\Exceptions\LinkHelperException;

class LinksHelper
{
    public static function generateShortKey(): string
    {
        $time = time();
        $key = '';
        $mt = explode(' ',microtime());
        $mt = explode('.',$mt[0]);
        $mt = str_split($mt[1], 2);
        $time .= $mt[0];
        foreach (str_split($time, 2) as $item){
            if(!isset(DictionaryEnum::DICTIONARY[$item]))
                throw new LinkHelperException("Error generating short key");
            $key .= DictionaryEnum::DICTIONARY[$item];
        }
        return $key;
    }
}
