<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserDetailController extends Controller
{
    public function editOrUpdate(Request $request)
    {
        $userDetail = UserDetail::where('user_id', Auth::id())->firstOrFail();

        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'phone' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'id_card' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'bank_name' => 'required|string|max:255',
                'account_name' => 'required|string|max:255',
                'account_number' => 'required|string|max:255',
            ]);

            if ($request->hasFile('id_card')) {
                $fileName = uniqid() . '.' . $request->file('id_card')->getClientOriginalExtension();
                $path = $request->file('id_card')->storeAs('private/id_cards', $fileName);

                if ($userDetail->id_card && Storage::exists($userDetail->id_card)) {
                    Storage::delete($userDetail->id_card);
                }

                $validatedData['id_card'] = $path;
            }

            $userDetail->update($validatedData);

            session()->flash('success', 'Profile updated successfully.');
            return redirect()->route('profile');
        }

        return view('frontend.user-detail.edit', compact('userDetail'));
    }

    public function getIdCard()
    {
        $userDetail = UserDetail::where('user_id', auth()->user()->id)->firstOrFail();
        $fileName = $userDetail->id_card;

        return Storage::disk('local')->response($fileName);
    }
}
