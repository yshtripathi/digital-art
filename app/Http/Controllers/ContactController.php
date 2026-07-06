<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function sendContact(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'subject' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ];

        if (env('CAPTCHA_ENABLED', true)) {
            $rules['captcha'] = 'required|captcha';
        }

        $request->validate($rules);

        $data = $request->all();
        $admin = env('MAIL_FROM_ADDRESS') ?? config('mail.from.address') ?? 'support@example.com';

        if (!$admin || empty(trim($admin))) {
            return redirect('contact')->with('error', __('common.email_configuration_error') ?? 'Email configuration error. Please contact support.');
        }

       // Mail::to($admin)->send(new ContactMail($data));
        
        return redirect('contact')->with('success', __('common.message_sent_successfully'));
    }
}
