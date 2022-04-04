<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Specialdate;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all(),200);
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'weekendinflation' => $request->weekendinflation,
            'specialdayinflation' => $request->specialdayinflation,
            'groupdiscount' => $request->groupdiscount,
        ]);

        return response()->json([
            'status' => (bool) $product,
            'data'   => $product,
            'message' => $product ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    public function show(Product $product)
    {
        return response()->json($product,200);
    }



    public function update(Request $request, $id)
    {
        $status = Product::where('id', $id)->update(
            $request->only(['name', 'price', 'weekendinflation', 'specialdayinflation', 'groupdiscount'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Specialdate update!' : 'Error Updating Specialdate'
        ]);
    }

    public function destroy($id)
    {
        $status = Product::where('id', $id)->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Specialdate Deleted!' : 'Error Deleting Specialdate'
        ]);
    }
}
