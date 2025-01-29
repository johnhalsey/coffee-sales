<?php

namespace App\Http\Controllers\Api;

use App\Models\Sale;
use App\Enums\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaleRequest;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $sales = Sale::where('user_id', $request->user()->id)->get();

        return response()->json($sales);
    }

    public function store(StoreSaleRequest $request)
    {
        Sale::create([
            'user_id'      => $request->user()->id,
            'product_name' => Product::GOLD->value,
            'quantity'     => (int) $request->input('quantity'),
            'unit_cost'   => (float) $request->input('unit_cost'),
            'selling_cost' => (float) $request->input('selling_cost'),
        ]);

        return response()->json(['message' => 'Order created successfully']);
    }
}
