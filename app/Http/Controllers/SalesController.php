<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $product = \App\Enums\Product::GOLD;

        return Inertia::render('Sales', [
            'markup' => $product->markup(),
            'shipping' => $product->shipping(),
        ]);
    }
}
