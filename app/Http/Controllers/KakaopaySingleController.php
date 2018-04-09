<?php

namespace App\Http\Controllers;

use App\PaymentHistory;
use se468\Kakaopay\Payment;
use Illuminate\Http\Request;
use se468\Kakaopay\Kakaopay;

class KakaopaySingleController extends Controller
{
    public function test(Request $request)
    {
        $payment = new Payment();
        Kakaopay::setAdminKey(env('KAKAOPAY_ADMIN_KEY'));

        $result = $payment->ready([
            'cid' => 'TC0ONETIME',
            'partner_order_id' => 'partner_order_id',
            'partner_user_id' => 'partner_user_id',
            'item_name' => '초코파이',
            'quantity' => '1',
            'total_amount' => '2200',
            'vat_amount' => '200',
            'tax_free_amount' => '0',
            'approval_url' => url('kakaopay/single/success'),
            'cancel_url' => url('kakaopay/single/cancel'),
            'fail_url' => url('kakaopay/single/fail')
        ]);
        $request->session()->put('tid', $result->tid);

        return redirect($result->next_redirect_pc_url);
    }

    public function success(Request $request)
    {
        $input = $request->all();
        $payment = new Payment();
        Kakaopay::setAdminKey(getenv('KAKAOPAY_ADMIN_KEY'));
        $result = $payment->approve([
            'cid' => 'TC0ONETIME',
            'tid' => $request->session()->get('tid'),
            'partner_order_id' => 'partner_order_id',
            'partner_user_id' => 'partner_user_id',
            'pg_token' => $input['pg_token']
        ]);
        
        $request->session()->forget('tid');
        $request->session()->put('last_transaction', $result);

        $history = PaymentHistory::create([
            'data' => json_encode($result)
        ]);

        return redirect('kakaopay/single/complete');
    }

    public function fail(Request $request)
    {
        dd("Failed");
    }

    public function cancel(Request $request)
    {
        dd("Cancelled");
    }

    public function complete(Request $request)
    {
        $result = $request->session()->get('last_transaction');
        return view('kakaopay.success', [
            'result' => $result
        ]);
    }
}
