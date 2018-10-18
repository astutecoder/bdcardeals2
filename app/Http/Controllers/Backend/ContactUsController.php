<?php

namespace App\Http\Controllers\Backend;

use App\Mail\Inquiry;
use App\Mail\ReceiveConfirmation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function send_mail(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $subject = $request->input('subject');
        $inquiry_for = $request->input('inquiry_for');
        $inquiry_for_source = $request->input('inquiry_for_source');
        $message = $request->input('message');

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Mail::to($email)
                ->send(new ReceiveConfirmation($name));
        Mail::to('badhontrading@gmail.com')
                ->send(new Inquiry($name, $email, $phone, strtoupper($subject), $message, $inquiry_for, $inquiry_for_source));
    }
}
