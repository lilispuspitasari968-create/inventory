<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;

class ItemController extends BaseController
{
    public function index()
    {
        $items = Item::with('category')->get();
        return $this->success($items, 'Items retrieved successfully');
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->validated());
        $item->load('category');
        return $this->success($item, 'Item created successfully', 201);
    }

    public function show($id)
    {
        $item = Item::with('category')->find($id);
        if (!$item) return $this->error('Item not found', 404);
        return $this->success($item, 'Item retrieved successfully');
    }

    public function update(UpdateItemRequest $request, $id)
    {
        $item = Item::find($id);
        if (!$item) return $this->error('Item not found', 404);
        $item->update($request->validated());
        return $this->success($item->load('category'), 'Item updated successfully');
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        if (!$item) return $this->error('Item not found', 404);
        $item->delete();
        return $this->success([], 'Item deleted successfully');
    }
}