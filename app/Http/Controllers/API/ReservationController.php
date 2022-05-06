<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function index()
    {
        return response()->json(Reservation::with(['product','user','extras'])->get(),200);
    }

    public function store(Request $request)
    {


            $user = User::find($request->user_id);

            try {

                $payment = $user->charge(
                    $request->input('amount'),
                    $request->input('payment_method_id'),
                );

                $payment = $payment->asStripePaymentIntent();


                $reservation = Reservation::create([
                    'user_id' => $request->user_id,
                    'startdate' => $request->startdate,
                    'finishdate' => $request->finishdate,
                    'starttime' => $request->starttime,
                    'finishtime' => $request->finishtime,
                    'slot_id' => $request->slot_id,
                    'fullday' => $request->fullday,
                    'guests' => $request->guests,
                    'amount' => $request->amount,
                    'product_id' => $request->product_id,
                    'transactionID' => $request->transactionID,
                    'cardBrand' => $request->cardBrand,
                    'lastFour' => $request->lastFour,
                    'expire' => $request->expire,
                    'language' => $request->language
                ]);

                $user = User::find($request->user_id);

                $reservation = Reservation::where('transactionID', $request->transactionID)->first();

                if ($reservation->language == 'FR') {

                    Mail::send('email.orderSuccessFR', ['order' => $reservation, 'user' => $user], function ($message) use ($request) {


                        $reservation = Reservation::where('transactionID', $request->transactionID)->first();

                        $user = User::where('id', $request->user_id)->first();

                        $message->to($user->email);
                        $message->to('gl.tiengo@gmail.com');

                        $message->subject('Récapitulatif de la commande');

                    });

                    return $reservation;

                } else {


                    Mail::send('email.orderSuccessEn', ['order' => $reservation, 'user' => $user], function ($message) use ($request) {


                        $reservation = Reservation::where('transactionID', $request->transactionID)->first();

//                        $message->to(Auth::user()->email);
                        $message->to('gl.tiengo@gmail.com');

                        $message->subject('Récapitulatif de la commande');

                    });

                    return $reservation;

                }

            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }

    }


    public function create(Request $request)
    {

        $user = User::find($request->user_id);

            $reservation = Reservation::create([
                'user_id' => $request->user_id,
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




            $reservation = Reservation::where('user_id', $request->user_id)->latest()->first();

            if ( $reservation->language == 'FR') {

                Mail::send('email.orderSuccessFR', ['order' => $reservation, 'user' => $user], function ($message) use ($request) {


                    $reservation = Reservation::where('transactionID', $request->transactionID)->first();

                    $user = User::where('id', $request->user_id)->first();
                    $message->to($user->email);
                    $message->to('gl.tiengo@gmail.com');

                    $message->subject('Récapitulatif de la commande');

                });

                return $reservation;

            } else {


                Mail::send('email.orderSuccessEn', ['order' => $reservation, 'user' => $user], function ($message) use ($request) {


                    $reservation = Reservation::where('user_id', $request->user_id)->latest()->first();

                    $user = User::where('id', $request->user_id)->first();

                    $message->to($user->email);
                    $message->to('gl.tiengo@gmail.com');

                    $message->subject('Récapitulatif de la commande');

                });

                return $reservation;

            }

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

    public function fulldaysadmin(Request $request)
    {
        return response()->json(Reservation::where('fullday', 1)->with(['product','user','extras'])->get(),200);
    }

    public function slots(Request $request)
    {
        return response()->json(Reservation::where('fullday', 0)->with(['product','user','extras'])->get(),200);
    }

    public function verifyfulldays(Request $request)
    {
        return response()->json(Reservation::where('fullday', 1)->get());

    }
    public function verifytimeslots(Request $request)
    {
        return response()->json(Reservation::where('fullday', 0)
            ->where('startdate', $request->startdate)
            ->where('finishdate', $request->finishdate)
            ->where('slot_id', $request->slot_id)
            ->get(),200);
    }

}
