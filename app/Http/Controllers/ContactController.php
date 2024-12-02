<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\ContactForm;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'messages' => 'required|string|max:2000',
        ]);

        ContactForm::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['messages'],
        ]);
        Mail::to('jorn.de.smet@student.ehb.be')->send(new ContactMail($request->all()));


        return redirect()->route('contact.index')->with('success', 'Your message has been sent successfully!');
    }
}
