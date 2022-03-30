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
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return response()->json([
            'status' => (bool) $checkout,
            'data'   => $checkout,
            'message' => $checkout ? 'Checkout Created!' : 'Error Creating Checkout'
        ]);
    }

    public function store(Request $request)
    {
        $checkout = Checkout::create([
            'slot' => $request->slot,
            'name' => $request->name,
            'price' => $request->price,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return response()->json([
            'status' => (bool) $checkout,
            'data'   => $checkout,
            'message' => $checkout ? 'Checkout Created!' : 'Error Creating Checkout'
        ]);
    }

    public function show(Checkout $checkout)
    {
        return response()->json($checkout,200);
    }


    public function update(Request $request, $id)
    {
        $status = Checkout::where('id', $id)->update(
        $request->only(['slot','name', 'price', 'start', 'end'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Checkout Updated!' : 'Error Updating Checkout'
        ]);
    }

    public function destroy($id)
    {
        $status = Checkout::where('id', $id)->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Checkout Deleted!' : 'Error Deleting Checkout'
        ]);
    }
}
