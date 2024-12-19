<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::with('user_details')
            ->where('role_id', User::ROLE_USER)
            ->orderBy('name', 'asc')
            ->get();

        return view('backend.user.customer.index', compact('customers'));
    }

    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('backend.user.customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = User::with('user_details')->findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $customer->id,
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'id_card' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $customer->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        $detailsData = $request->only('phone', 'address');

        if ($request->hasFile('id_card')) {
            $fileName = uniqid() . '.' . $request->file('id_card')->getClientOriginalExtension();
            $path = $request->file('id_card')->storeAs('private/id_cards', $fileName);

            if ($customer->user_details && $customer->user_details->id_card && Storage::exists($customer->user_details->id_card)) {
                Storage::delete($customer->user_details->id_card);
            }

            $detailsData['id_card'] = $path;
        }

        $customer->user_details()->updateOrCreate([], $detailsData);

        session()->flash('success', 'Customer updated successfully.');
        return redirect()->route('customer.index');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('success', 'Customer deleted successfully.');
        return redirect()->route('customer.index');
    }
}
