<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CalculationController extends Controller
{
    public function addition(Request $request)
    {
        $total = $request->firstValue + $request->secondValue; // Correct the operation to addition
        $user = auth()->user();
        $user->Credits->credits -= 1; // Subtract 1 credit
        $user->Credits->save(); // Save the updated credits

        return redirect()->back()->with('total', $total);
    }
}
