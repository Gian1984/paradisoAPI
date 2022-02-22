<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Timeslots;
use Illuminate\Http\Request;

class TimeslotsController extends Controller
{
    public function index()
    {
        return response()->json(Timeslots::all(),200);
    }

    public function store(Request $request)
    {
        $timeslots = Timeslots::create([
            'name' => $request->name,
            'start' => $request->start,
            'end' => $request->end,
            'price' => $request->price,
        ]);

        return response()->json([
            'status' => (bool) $timeslots,
            'data'   => $timeslots,
            'message' => $timeslots ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    public function show(Timeslots $timeslots)
    {
        return response()->json($timeslots,200);
    }


    public function update(Request $request, Timeslots $timeslots)
    {
        $status = $timeslots->update(
            $request->only(['name', 'start', 'end', 'price'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    public function destroy(Timeslots $timeslots)
    {
        $status = $timeslots->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
