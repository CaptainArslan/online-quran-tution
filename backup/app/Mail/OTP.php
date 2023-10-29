<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class OTP extends Mailable
{
    protected $otp = '';

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->view('emails.o-t-p', [
            'otp'=>$this->otp,
        ]);
    }
}
