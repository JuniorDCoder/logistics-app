<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public ContactMessage $contactMessage;

    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    public function build(): self
    {
        $subjectLine = $this->contactMessage->subject
            ? 'New Contact Inquiry: '.$this->contactMessage->subject
            : 'New Contact Inquiry from '.$this->contactMessage->name;

        return $this->subject($subjectLine)
            ->view('emails.contact-message-notification');
    }
}
