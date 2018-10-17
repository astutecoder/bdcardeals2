<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Inquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $email, $subject, $phone, $msg, $inq_for, $inq_for_source;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone, $subject, $msg, $inq_for, $inq_for_source)
    {
        $this->name = strtoupper($name);
        $this->email = $email;
        $this->subject = $subject;
        $this->phone = $phone;
        $this->msg = $msg;
        $this->$inq_for = strtoupper($inq_for);
        $this->$inq_for_source = strtoupper($inq_for_source);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.inquiry.inquiry_arrived')
            ->with([
                'name'=> $this->name,
                'email'=>$this->email,
                'phone'=>$this->phone,
                'msg'=>$this->msg,
                'inq_for'=>$this->inq_for,
                'inq_for_source'=>$this->inq_for_source,
            ]);
    }
}
