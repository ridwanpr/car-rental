<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\PaymentApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentRequestController extends Controller
{
    public function index()
    {
        $payments = Payment::with('paymentMethod')
            ->where('payment_proof', '!=', null)
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.payment-request.index', compact('payments'));
    }

    public function show($id)
    {
        $payment = Payment::with('paymentMethod')->findOrFail($id);
        return view('backend.payment-request.show', compact('payment'));
    }

    public function getPaymentById($id)
    {
        $payment = Payment::with('paymentMethod', 'user')
            ->leftJoin('user_details', 'payments.user_id', '=', 'user_details.user_id')
            ->select('payments.*', 'user_details.phone as user_phone')
            ->find($id);

        $filename = str_replace('payment_proofs/', '', $payment->payment_proof);
        $paymentProofUrl = route('payment.proof', ['filename' => $filename]);


        return response()->json([
            'data' => $payment,
            'payment_proof_url' => $paymentProofUrl,
            'status' => 'success',
            'message' => 'Payment details fetched successfully'
        ]);
    }

    public function getPaymentProof($filename)
    {
        return Storage::disk('local')->response('payment_proofs/' . $filename);
    }

    public function approvePayment($id)
    {
        $payment = Payment::find($id);
        $payment->status = 'approved';
        $payment->save();

        $user = User::find($payment->user_id);
        $user->notify(new PaymentApproved($payment));

        return response()->json([
            'status' => 'success',
            'message' => 'Payment approved successfully'
        ]);
    }

    public function rejectPayment($id)
    {
        $payment = Payment::find($id);
        $payment->status = 'declined';
        $payment->save();

        $user = User::find($payment->user_id);
        $user->notify(new PaymentApproved($payment));

        return response()->json([
            'status' => 'success',
            'message' => 'Payment declined successfully'
        ]);
    }
}
