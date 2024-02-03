<?php

namespace App\Http\Controllers;

use App\Http\Services\Interfaces\LinkServiceInterface;
use Illuminate\Http\Request;

class MainCotroller extends Controller
{
    protected $linkService;

    public function __construct(LinkServiceInterface $linkService)
    {
        $this->linkService = $linkService;
    }


    public function index(Request $request){
        return $this->linkService->store(['link'=>$request->link]);
    }

    public function redirect($key){
        $linkObject = $this->linkService->getByShortKey($key);
        return redirect($linkObject->link);
    }
}
