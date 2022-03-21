<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use App\Models\Timeslots;
use Illuminate\Http\Request;

class ExtrasController extends Controller
{

    public function index()
    {
        return response()->json(Extra::all(),200);
    }


    public function create(Request $request)
    {


            foreach ($request as $data) {
                $container = Extra::create([
                    'reservation_id' => $data->reservation_id,
                    'name' => $data->name,
                    'price' => $data->price,
                    'quantity' => $data->quantity,
                ]);

                $container->save();
            }

            return response()->json('Successfully added');
    }


    public function store(Request $request)

    {


        foreach( $request ->data as $data) {

            $extra = New Extra([
                'reservation_id' => $data['reservation_id'],
                'name' => $data['name'],
                'price' => $data['price'],
                'quantity' => $data['quantity'],
            ]);

            $extra ->save();
        }

        return response()->json([
            'status' => (bool)$extra,
            'data' => $extra,
            'message' => $extra ? 'Product Created!' : 'Error Creating Product'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Extra  $extra
     * @return \Illuminate\Http\Response
     */
    public function show(Extra $extra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Extra  $extra
     * @return \Illuminate\Http\Response
     */
    public function edit(Extra $extra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Extra  $extra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Extra $extra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Extra  $extra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Extra $extra)
    {
        //
    }
}
