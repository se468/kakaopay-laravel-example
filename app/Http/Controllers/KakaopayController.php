<?php

namespace App\Http\Controllers;

use App\PaymentHistory;
use se468\Kakaopay\Payment;
use Illuminate\Http\Request;
use se468\Kakaopay\Kakaopay;

class KakaopayController extends Controller
{
    public function index()
    {
        $histories = PaymentHistory::all();
        return view('kakaopay.index', [
            'histories' => $histories
        ]);
    }

    public function show($id)
    {
        $history = PaymentHistory::find($id);
        return view('kakaopay.show', [
            'history' => $history
        ]);
    }
}
