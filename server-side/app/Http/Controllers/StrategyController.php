<?php

namespace App\Http\Controllers;

use App\Http\Requests\Strategy\CreateRequest;
use App\Http\Requests\Strategy\UpdateRequest;
use App\Http\Resources\StrategyResource;
use App\Services\StrategyServiceInterface;

class StrategyController extends Controller
{
    public $strategy_service;

    public function __construct(StrategyServiceInterface $strategy_service)
    {
        $this->strategy_service = $strategy_service;
    }

    public function index()
    {
        return StrategyResource::collection($this->strategy_service->all())->resolve();
    }

    public function create(CreateRequest $request)
    {
        if ($this->strategy_service->exists($request->get('staff_id'), $request->get('member_id'))) {
            return response()->json([
                'message' => __('Strategy already exists'),
            ], 400);
        }

        $this->strategy_service->create($request->get('staff_id'), $request->get('member_id'), $request->get('min_limit'), $request->get('max_limit'), $request->get('tariff'));

        return response()->json([
            'message' => __('Success'),
        ]);
    }

    public function update(UpdateRequest $request, int $id)
    {
        $this->strategy_service->update($id, $request->all());

        return response()->json([
            'message' => __('Success'),
        ]);
    }

    public function enable(int $id)
    {
        $this->strategy_service->update($id, ['active' => true]);

        return response()->json([
            'message' => __('Success'),
        ]);
    }

    public function disable(int $id)
    {
        $this->strategy_service->update($id, ['active' => false]);

        return response()->json([
            'message' => __('Success'),
        ]);
    }
}
