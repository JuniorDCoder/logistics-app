<?php

namespace App\Mail;

use App\Models\MailTemplate;
use App\Models\Shipment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShipmentNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $renderedSubject;
    public string $renderedBody;

    public function __construct(public Shipment $shipment, public string $templateKey, public array $placeholders = [])
    {
        $rendered = MailTemplate::render($templateKey, $placeholders);

        $this->renderedSubject = $rendered['subject'] ?? ($placeholders['app_name'] ?? config('app.name')) . ' Shipment Notification';
        $this->renderedBody = $rendered['body'] ?? '';
    }

    public function build(): self
    {
        return $this->subject($this->renderedSubject)
            ->view('emails.shipment-notification', [
                'bodyHtml' => $this->renderedBody,
                'shipment' => $this->shipment,
            ]);
    }
}
