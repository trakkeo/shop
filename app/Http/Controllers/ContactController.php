<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(ContactRequest $request)
    {
        Mail::to('adrienbillard@trakkeo.com')->send(new ContactMail($request->validated()));
        return back()->with('success', 'Votre message a été envoyé avec succès.');
    }
}
