<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return response()->json(Checkout::all(),200);
    }

    public function create(Request $request)
    {
        $checkout = Checkout::create([
            'slot' => $request->slot,
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return response()->json([
            'status' => (bool) $checkout,
            'data'   => $checkout,
            'message' => $checkout ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    public function store(Request $request)
    {
        $checkout = Checkout::create([
            'slot' => $request->slot,
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return response()->json([
            'status' => (bool) $checkout,
            'data'   => $checkout,
            'message' => $checkout ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    public function show(Checkout $checkout)
    {
        return response()->json($checkout,200);
    }


    public function update(Request $request, Checkout $checkout)
    {
        $status = $checkout->update(
            $request->only(['slot','name', 'price'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    public function destroy(Checkout $checkout)
    {
        $status = $checkout->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
