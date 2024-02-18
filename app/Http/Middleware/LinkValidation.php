<?php

namespace App\Http\Middleware;

use App\Exceptions\LinkMiddlewareException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LinkValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $validator = Validator::make(
            $request->all(),
            [
                'link' => 'required|url|max:255'
            ]
        );

        if($validator->fails()){
            throw new LinkMiddlewareException('incorrect link structure');
        }

        return $next($request);
    }
}
