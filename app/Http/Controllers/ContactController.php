<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

public function store(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'mobile'  => 'nullable|string|max:15', 
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string',
    ]);

    $contact = Contact::create([
        'name'    => $request->name,
        'email'   => $request->email,
        'mobile'  => $request->mobile, 
        'subject' => $request->subject,
        'message' => $request->message,
    ]);

  
    Mail::send('emails.contact_admin', ['contact' => $contact], function ($mail) use ($contact) {
        $mail->to('Naturoliapharma@gmail.com')
             ->subject('New Contact Message from ' . $contact->name);
    });

   
    Mail::send('emails.contact_user', ['contact' => $contact], function ($mail) use ($contact) {
        $mail->to($contact->email)
             ->subject('Thank You for Contacting Naturoliapharma');
    });

    return back()->with('success', 'Your message has been sent successfully!');
}

}
