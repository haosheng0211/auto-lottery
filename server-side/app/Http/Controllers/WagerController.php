<?php

namespace App\Http\Controllers;

use App\Http\Resources\WagerResource;
use App\Services\WagerServiceInterface;
use Illuminate\Http\Request;

class WagerController extends Controller
{
    public $wager_service;

    public function __construct(WagerServiceInterface $wager_service)
    {
        $this->wager_service = $wager_service;
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        if ($request->get('limit')) {
            $limit = $request->input('limit');
        } else {
            $limit = 30;
        }

        return WagerResource::collection($this->wager_service->all($limit))->resolve();
    }
}
