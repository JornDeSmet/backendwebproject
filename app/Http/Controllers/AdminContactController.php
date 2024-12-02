<?php

namespace App\Http\Controllers;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminContactController extends Controller
{
    public function index()
    {
        $contactForms = ContactForm::all();
        return view('admin-contact.index', compact('contactForms'));
    }


    public function show($id)
    {
        $contactForm = ContactForm::findOrFail($id);
        return view('admin-contact.show', compact('contactForm'));
    }


    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply_message' => 'required|string|max:2000',
        ]);

        $contactForm = ContactForm::findOrFail($id);


        Mail::raw($request->reply_message, function ($message) use ($contactForm) {
            $message->to($contactForm->email)
                    ->subject('Reply to Your Contact Form Submission');
        });


        $contactForm->update(['replied' => true]);

        return redirect()->route('admin-contact.index')->with('success', 'Reply sent successfully!');
    }
}
