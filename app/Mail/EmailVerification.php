<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use App\Models\User;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $verificationUrl;

    /**
     * Create a new message instance.
     *
     * @param  User  $student
     * @return void
     */
    public function __construct(User $student)
    {
        $this->student = $student;
        $this->verificationUrl = $this->generateVerificationUrl($student);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Email Verification')
            ->view('emails.verify')
            ->with('student', $this->student)
            ->with('verificationUrl', $this->verificationUrl);
    }

    /**
     * Generate the email verification URL.
     *
     * @param  User  $user
     * @return string
     */
    protected function generateVerificationUrl($user)
    {
        $verificationUrl = URL::temporarySignedRoute(
            'student.dashboard',
            now()->addMinutes(60),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );

        return $verificationUrl;
    

    }
   
}
