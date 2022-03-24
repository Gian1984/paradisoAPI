<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{

    public function index()
    {
        return response()->json(Group::all(),200);
    }

    public function create(Request $request)
    {
        $checkout = Group::create([
            'value' => $request->value,
            'name' => $request->name,
            'discount' => $request->discount,
        ]);

        return response()->json([
            'status' => (bool) $checkout,
            'data'   => $checkout,
            'message' => $checkout ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    public function store(Request $request)
    {
        $checkout = Group::create([
            'value' => $request->value,
            'name' => $request->name,
            'discount' => $request->discount,
        ]);

        return response()->json([
            'status' => (bool) $checkout,
            'data'   => $checkout,
            'message' => $checkout ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    public function show(Group $group)
    {
        return response()->json($group,200);
    }


    public function update(Request $request, Group $group)
    {
        $status = $group->update(
            $request->only(['value','name','discount'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    public function destroy(Group $group)
    {
        $status = $group->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
