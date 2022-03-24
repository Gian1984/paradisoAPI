<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Specialdate;
use Illuminate\Http\Request;

class SpecialdateController extends Controller
{

    public function index()
    {
        return response()->json(Specialdate::all(),200);
    }

    public function create(Request $request)
    {
        $specialdate = Specialdate::create([
            'name' => $request->name,
            'fromDate' => $request->fromDate,
            'toDate' => $request->toDate,
        ]);

        return response()->json([
            'status' => (bool) $specialdate,
            'data'   => $specialdate,
            'message' => $specialdate ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    public function store(Request $request)
    {
        $specialdate = Specialdate::create([
            'name' => $request->name,
            'fromDate' => $request->fromDate,
            'toDate' => $request->toDate,
        ]);

        return response()->json([
            'status' => (bool) $specialdate,
            'data'   => $specialdate,
            'message' => $specialdate ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    public function show(Specialdate $specialdate)
    {
        return response()->json($specialdate,200);
    }


    public function update(Request $request, Specialdate $specialdate)
    {
        $status = $specialdate->update(
            $request->only(['value','name','discount'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    public function destroy(Specialdate $specialdate)
    {
        $status = $specialdate->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
