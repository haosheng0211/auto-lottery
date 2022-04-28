<?php

namespace App\Http\Controllers;

use App\Http\Resources\MemberResource;
use App\Services\MemberServiceInterface;

class MemberController extends Controller
{
    public $member_service;

    public function __construct(MemberServiceInterface $member_service)
    {
        $this->member_service = $member_service;
        $this->middleware('auth:api');
    }

    public function index()
    {
        return MemberResource::collection($this->member_service->all())->resolve();
    }

    public function selectOptions()
    {
        return $this->member_service->selectOptions();
    }
}
