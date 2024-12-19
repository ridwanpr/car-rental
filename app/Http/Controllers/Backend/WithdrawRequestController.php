<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    public function index()
    {
        $withdraws = Withdraw::join('user_details', 'withdraw.user_id', 'user_details.user_id')
            ->join('users', 'withdraw.user_id', 'users.id')
            ->orderBy('withdraw.created_at', 'desc')
            ->select(
                'withdraw.*',
                'users.name',
                'user_details.phone',
                'user_details.bank_name',
                'user_details.account_name',
                'user_details.account_number'
            )
            ->get();

        return view('backend.withdraw.index', compact('withdraws'));
    }

    public function show($id)
    {
        $withdraw = Withdraw::join('user_details', 'withdraw.user_id', 'user_details.user_id')
            ->join('users', 'withdraw.user_id', 'users.id')
            ->where('withdraw.id', $id)
            ->orderBy('withdraw.created_at', 'desc')
            ->select(
                'withdraw.*',
                'users.name',
                'user_details.phone',
                'user_details.bank_name',
                'user_details.account_name',
                'user_details.account_number'
            )
            ->firstOrFail();

        return view('backend.withdraw.show', compact('withdraw'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'proof' => 'required|image|max:2048',
        ]);

        $withdraw = Withdraw::findOrFail($id);

        if ($withdraw->status !== 'pending') {
            return back()->with('error', 'Proof can only be uploaded for pending withdrawals.');
        }

        if ($request->hasFile('proof')) {
            $filePath = $request->file('proof')->store('proofs', 'public');
            $withdraw->proof = $filePath;
            $withdraw->status = 'transferred';
            $withdraw->save();

            return back()->with('success', 'Proof uploaded and withdrawal marked as transferred.');
        }

        return back()->with('error', 'Failed to upload proof.');
    }
}
