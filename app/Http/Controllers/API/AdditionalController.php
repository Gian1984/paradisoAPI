<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Additional;
use Illuminate\Http\Request;

class AdditionalController extends Controller
{
    public function index()
    {
        return response()->json(Additional::all(),200);
    }

    public function store(Request $request)
    {
        $additional = Additional::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
            'language'=> $request->language,
        ]);

        return response()->json([
            'status' => (bool) $additional,
            'data'   => $additional,
            'message' => $additional ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    public function show(Additional $additional)
    {
        return response()->json($additional,200);
    }

    public function uploadFile(Request $request)
    {
        if($request->hasFile('image')){

            $name = time()."_".$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $name);
        }
        return response()->json(asset("images/$name"),201);
    }

    public function update(Request $request, Additional $additional)
    {
        $status = $additional->update(
            $request->only(['name', 'description', 'price', 'image','language'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    public function destroy(Additional $additional)
    {
        $status = $additional->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
