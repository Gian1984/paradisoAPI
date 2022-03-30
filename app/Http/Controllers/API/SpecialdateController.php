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
            'fromMonth' => $request->fromMonth,
            'toMonth' => $request->toMonth,

        ]);

        return response()->json([
            'status' => (bool) $specialdate,
            'data'   => $specialdate,
            'message' => $specialdate ? 'Specialdate Created!' : 'Error Creating Specialdate'
        ]);
    }

    public function store(Request $request)
    {
        $specialdate = Specialdate::create([
            'name' => $request->name,
            'fromDate' => $request->fromDate,
            'toDate' => $request->toDate,
            'fromMonth' => $request->fromMonth,
            'toMonth' => $request->toMonth,
        ]);

        return response()->json([
            'status' => (bool) $specialdate,
            'data'   => $specialdate,
            'message' => $specialdate ? 'Specialdate Created!' : 'Error Creating Specialdate'
        ]);
    }

    public function show(Specialdate $specialdate)
    {
        return response()->json($specialdate,200);
    }


    public function update(Request $request, $id )
    {

        $status = Specialdate::where('id', $id)->update(
            $request->only(['name', 'fromDate', 'toDate', 'fromMonth', 'toMonth'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Specialdate update!' : 'Error Updating Specialdate'
        ]);

    }

    public function destroy($id)
    {
        $status = Specialdate::where('id', $id)->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Specialdate Deleted!' : 'Error Deleting Specialdate'
        ]);
    }
}
