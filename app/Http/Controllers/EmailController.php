<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string',
            'body' => 'required|string',
            'email' => 'required|email',
        ]);

        Mail::to($validated['email'])->send(new GenericMail($validated['subject'], $validated['body']));

        return response()->json(['message' => 'Email sent successfully'], Response::HTTP_OK);
    }
}
