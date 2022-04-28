<?php

namespace App\Http\Controllers;

use App\Http\Resources\TrackResource;
use App\Services\TrackServiceInterface;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public $track_service;

    public function __construct(TrackServiceInterface $track_service)
    {
        $this->track_service = $track_service;
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        if ($request->get('limit')) {
            $limit = $request->input('limit');
        } else {
            $limit = 30;
        }

        return TrackResource::collection($this->track_service->all($limit))->resolve();
    }
}
