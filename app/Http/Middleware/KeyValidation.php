<?php

namespace App\Http\Middleware;

use App\Exceptions\KeyMiddlewareException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class KeyValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        dd($request->key);
       $validator = Validator::make(
           $request->all(),
           [
                'key' => 'exists:App\Models\Link,short_key|max_digits:12'
           ]
       );

       if($validator->fails()){
           throw new KeyMiddlewareException('Invalid key structure or key does not exists');
       }

        return $next($request);
    }
}
