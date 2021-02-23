<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Requests\ItemSave as ItemSaveRequest;
use App\Http\Requests\UpdateStatus as UpdateStatusRequest;
use App\Http\Resources\Item as ItemResource;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            "items" => ItemResource::collection(Item::orderBy('created_at', 'DESC')->get())
        ],200);
    }

    public function create(ItemSaveRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['status'] = true;

        $item = Item::create($validatedData);

        return response()->json([
            'success' => true,
            "item" => new ItemResource($item)
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($itemId, UpdateStatusRequest $request)
    {
        $validatedData = $request->validated();

        $item = Item::where("id", $itemId)->first();

        if ($item) {
            $item->status = $validatedData['status'];
            $item->save();
            return response()->json([
                'success' => true,
                "message" => 'Item status updated',
                'item' => new ItemResource($item)
            ],200);

        } else {
            return response()->json([
                'success' => false,
                "message" => 'Item not founded'
            ],500);
        }

    }


    public function destroy($itemId)
    {
        $item = Item::where("id", $itemId)->first();

        if ($item) {
            $item->delete();
            return response()->json([
                'success' => true,
                "message" => 'Item deleted'
            ],200);
        } else {
            return response()->json([
                'success' => false,
                "message" => 'Item not founded'
            ],500);
        }

    }

    public function update($itemId, ItemSaveRequest $request)
    {
        $validatedData = $request->validated();

        $item = Item::where("id", $itemId)->first();

        if ($item) {
            $item->name = $validatedData['name'];
            $item->save();
            return response()->json([
                'success' => true,
                "message" => 'Item updated',
                'item' => new ItemResource($item)
            ],200);

        } else {
            return response()->json([
                'success' => false,
                "message" => 'Item not founded'
            ],500);
        }

    }

    public function get($itemId)
    {
        $item = Item::where("id", $itemId)->first();

        if ($item) {
            return response()->json([
                'success' => true,
                'item' => new ItemResource($item)
            ],200);
        } else {
            return response()->json([
                'success' => false,
                "message" => 'Item not founded'
            ],500);
        }

    }

}
