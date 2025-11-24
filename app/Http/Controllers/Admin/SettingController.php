<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::firstOrCreate(['id' => 1]);
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'address' => 'nullable|string',
            'social_facebook' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'social_youtube' => 'nullable|url',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        $setting = Setting::firstOrCreate(['id' => 1]);

        // Simpan pengaturan website
        $setting->update($request->except(['current_password', 'new_password', 'new_password_confirmation', '_token']));

        // Ubah password admin jika diminta
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, auth()->user()->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah.']);
            }
            auth()->user()->update(['password' => Hash::make($request->new_password)]);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}