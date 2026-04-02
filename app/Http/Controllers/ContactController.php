<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'message' => 'required|string|max:2000',
        ]);

        Mail::to(config('mail.contact_address'))
            ->queue(new ContactMail($validated));

        return redirect()->back()
            ->with('success', 'Pesan berhasil dikirim! Kami akan segera menghubungi kamu.');
    }
}