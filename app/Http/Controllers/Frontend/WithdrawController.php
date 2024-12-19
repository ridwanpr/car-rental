<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index()
    {
        $withdraws = Withdraw::with('user')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.withdraw.index', compact('withdraws'));
    }

    public function create()
    {
        $userBalance = auth()->user()->user_details->balance;
        return view('frontend.withdraw.create', compact('userBalance'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $userDetail = $user->user_details;
        $userBalance = $userDetail->balance;

        $request->validate([
            'amount' => [
                'required',
                'numeric',
                'min:10000',
                'max:' . $userBalance,
            ],
        ], [
            'amount.min' => 'Minimum withdrawal amount is Rp 10,000',
            'amount.max' => 'Withdrawal amount cannot exceed your current balance of Rp ' . number_format($userBalance, 0, ',', '.'),
        ]);

        $withdraw = new Withdraw();
        $withdraw->user_id = $user->id;
        $withdraw->amount = $request->amount;
        $withdraw->status = 'pending';
        $withdraw->save();

        $userDetail->balance -= $request->amount;
        $userDetail->save();

        session()->flash('success', 'Withdraw created successfully.');
        return redirect()->route('withdraw.index');
    }
}
