<?php

namespace App\Http\Controllers\Api;

use App\Models\Sale;
use App\Enums\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SaleResource;
use App\Http\Requests\StoreSaleRequest;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $sales = Sale::query()
            ->with('product')
            ->where('user_id', $request->user()->id)
            ->get();

        return SaleResource::collection($sales);
    }

    public function store(StoreSaleRequest $request)
    {
        Sale::create([
            'user_id'      => $request->user()->id,
            'product_id'   => $request->input('product_id'),
            'quantity'     => (int) $request->input('quantity'),
            'unit_cost'    => (float) $request->input('unit_cost'),
            'selling_cost' => (float) $request->input('selling_cost'),
        ]);

        return response()->json(['message' => 'Order created successfully']);
    }
}
