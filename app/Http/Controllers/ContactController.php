<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Tampilkan halaman kontak
    public function show()
    {
        return view('contact');
    }

    // Proses form kontak
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Simpan ke database (opsional)
        Contact::create($request->only('name', 'email', 'subject', 'message'));

        // 🔜 Opsional: Kirim email (aktifkan nanti jika butuh)
        // Mail::to('info@meitytravel.com')->send(new ContactMail($request->all()));

        return redirect()->route('contact.show')
                         ->with('success', 'Pesan Anda telah terkirim! Kami akan segera menghubungi Anda.');
    }
}