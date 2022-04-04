<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Specialdate;
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
            'value' => $request->value,
            'available'=>$request->available
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


    public function update(Request $request, $id)
    {
        $status = Timeslots::where('id', $id)->update(
            $request->only(['name', 'start', 'end', 'price', 'value', 'available'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Specialdate update!' : 'Error Updating Specialdate'
        ]);
    }

    public function destroy($id)
    {
        $status = Timeslots::where('id', $id)->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Specialdate Deleted!' : 'Error Deleting Specialdate'
        ]);
    }
}
