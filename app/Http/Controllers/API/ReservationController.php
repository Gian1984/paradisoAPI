<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return response()->json(Reservation::all(),200);
    }

    public function store(Request $request)
    {
        $reservation = Reservation::create([
            'user_id' => '1',
            'startdate' => $request->startdate,
            'finishdate' => $request->finishdate,
            'timeslot_id' => $request->timeslot_id,
            'guests' => $request->guests,
            'amount' => $request->amount,
            'product_id' => $request->product_id,
            'transactionID' => $request->transactionID,
            'cardBrand' => $request->cardBrand,
            'lastFour' => $request->lastFour,
            'expire' => $request->expire,
            'language' => $request->language
        ]);

        return response()->json([
            'status' => (bool) $reservation ,
            'data'   => $reservation ,
            'message' => $reservation ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    public function show(Reservation $reservation )
    {
        return response()->json($reservation ,200);
    }


    public function update(Request $request, Reservation $reservation )
    {
        $status = $reservation ->update(
            $request->only(['user_id',
                'startdate',
                'finishdate',
                'timeslot_id',
                'guests',
                'amount',
                'product_id',
                'transactionID',
                'cardBrand',
                'lastFour',
                'expire',
                'language'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    public function destroy(Reservation $reservation )
    {
        $status = $reservation ->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
