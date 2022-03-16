<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return response()->json(Reservation::with(['product','user'])->get(),200);
    }

    public function store(Request $request)
    {
        $reservation = Reservation::create([
            'user_id' => '1',
            'startdate' => $request->startdate,
            'finishdate' => $request->finishdate,
            'starttime'=> $request->starttime,
            'finishtime'=> $request->finishtime,
            'slot_id' => $request->slot_id,
            'fullday'=> $request->fullday,
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
            $request->only([

                'user_id',
                'startdate',
                'finishdate',
                'starttime',
                'finishtime',
                'slot_id',
                'fullday',
                'guests',
                'amount',
                'product_id',
                'transactionID',
                'cardBrand',
                'lastFour',
                'expire',
                'language'

            ])
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

    public function slotdisponibility(Request $request)
    {
        return response()->json(Reservation::where('startdate', $request->date)->get(),200);
    }

    public function slotdisponibilityEnd(Request $request)
    {
        return response()->json(Reservation::where('finishdate', $request->date)->get(),200);
    }

    public function fulldays(Request $request)
    {
        return response()->json(Reservation::where('fullday', 1)->get(),200);
    }

    public function slots(Request $request)
    {
        return response()->json(Reservation::where('fullday', 0)->get(),200);
    }

}
