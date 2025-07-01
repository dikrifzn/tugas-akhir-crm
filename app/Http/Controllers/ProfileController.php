<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\ShippingAddresses;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function index()
    {
        $user = Auth::user();

        $orders = Order::with([
            'items.variant.product',
            'tracking'
        ])->where('user_id', $user->id)->latest()->get();

        return view('customer.profile', compact('user', 'orders'));
    }
    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Update basic user info
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Simpan gambar jika ada
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('image/users', 'public');
            $user->image_url = $path;
        }

        $user->save();

        // Simpan atau update alamat
        ShippingAddresses::updateOrCreate(
            ['user_id' => $user->id],
            [
                'recipient_name' => $request->recipient_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'province' => $request->province,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
            ]
        );

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
