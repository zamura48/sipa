<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        $id = $request->post('id');
        $bank = $request->post('bank');
        $pdf = $request->post('pdf');
        $payment_type = $request->post('payment_type');
        $transaction_id = $request->post('transaction_id');
        $va_number = $request->post('va_number');
        $transaction_status = $request->post('transaction_status');

        Tagihan::where('id', $id)->update([
            'bank' => $bank,
            'pdf' => $pdf,
            'payment_type' => $payment_type,
            'transaction_id' => $transaction_id,
            'va_number' => $va_number,
            'transaction_status' => $transaction_status,
            'status' => 2
        ]);

        return redirect()->route('walmur.tagihan.index');
    }
}
