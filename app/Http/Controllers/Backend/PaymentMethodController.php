<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return view('backend.payment-method.index', compact('paymentMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'account_number' => 'required',
            'account_name' => 'required',
            'bank_name' => 'required',
        ]);

        $id = substr(strtoupper(str_replace(' ', '_', $request->id)), 0, 5) . substr(uniqid(), -5);
        $id = str_pad($id, 10, '0', STR_PAD_LEFT);
        PaymentMethod::create([
            'id' => $id,
            'name' => $request->name,
            'description' => $request->description,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'bank_name' => $request->bank_name
        ]);

        session()->flash('success', 'Payment method created successfully.');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'account_number' => 'required',
            'account_name' => 'required',
            'bank_name' => 'required',
        ]);

        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->update([
            'name' => $request->name,
            'description' => $request->description,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'bank_name' => $request->bank_name
        ]);

        session()->flash('success', 'Payment method updated successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->delete();
        session()->flash('success', 'Payment method deleted successfully.');
        return redirect()->back();
    }
}
