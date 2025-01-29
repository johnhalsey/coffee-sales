<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Enums\Shipping;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Sales', [
            'products' => ProductResource::collection(Product::query()->get()),
            'shipping' => Shipping::STANDARD->value,
        ]);
    }
}
