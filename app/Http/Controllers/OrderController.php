<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Charge;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payment.stripe');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret_key'));

        $charge = Charge::create([
            'amount' => 999,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Test Payment',
        ]);
        if ($charge->status == 'succeeded') {
            Order::create([
                'user_id' => auth()->id(),
                'invoice_no' => $charge->balance_transaction,
                'payment_id' => $charge->id,
                'payment_method' => $charge->payment_method,
                'amount' => $charge->amount / 100,
                'status' => true,
            ]);

            // Update or Create Credit Entry
            Credit::updateOrCreate(
                ['user_id' => auth()->id()],
                ['credits' => DB::raw('COALESCE(credits, 0) + 10')]
            );
            return redirect()->route('dashboard')->with('toast', 'payment-succeeded');
        } else {
            return redirect()->route('dashboard')->with('toast', 'payment-failed');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
