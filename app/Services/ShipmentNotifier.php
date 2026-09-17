<?php

namespace App\Services;

use App\Mail\ShipmentNotification;
use App\Models\Shipment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ShipmentNotifier
{
    public static function created(Shipment $shipment): void
    {
        static::send($shipment, 'shipment_created');
    }

    public static function statusUpdated(Shipment $shipment, ?string $location = null, ?string $eventDescription = null): void
    {
        static::send($shipment, 'shipment_status_updated', [
            'location' => $location ?: $shipment->destination,
            'event_description' => $eventDescription ?: '',
        ]);
    }

    protected static function send(Shipment $shipment, string $templateKey, array $extra = []): void
    {
        if (setting('shipment_email_notifications', '1') === '0') {
            return;
        }

        $base = array_merge([
            'app_name' => app_name(),
            'tracking_number' => $shipment->tracking_number,
            'status' => $shipment->status_label,
            'status_label' => $shipment->status_label,
            'origin' => $shipment->origin,
            'destination' => $shipment->destination,
            'service_type' => Shipment::SERVICE_TYPES[$shipment->service_type] ?? $shipment->service_type,
            'estimated_delivery' => optional($shipment->estimated_delivery)->format('F j, Y') ?: 'To be confirmed',
            'sender_name' => $shipment->sender_name,
            'receiver_name' => $shipment->receiver_name,
            'tracking_url' => route('track', ['tracking_number' => $shipment->tracking_number]),
            'current_date' => now()->format('F j, Y'),
        ], $extra);

        $parties = [
            ['email' => $shipment->receiver_email, 'name' => $shipment->receiver_name],
            ['email' => $shipment->sender_email, 'name' => $shipment->sender_name],
        ];

        foreach ($parties as $party) {
            $email = trim((string) $party['email']);

            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                continue;
            }

            try {
                Mail::to($email)->queue(new ShipmentNotification(
                    $shipment,
                    $templateKey,
                    array_merge($base, ['recipient_name' => $party['name']])
                ));
            } catch (\Throwable $exception) {
                Log::warning('Failed to queue shipment notification email.', [
                    'shipment_id' => $shipment->id,
                    'template' => $templateKey,
                    'recipient' => $email,
                    'error' => $exception->getMessage(),
                ]);
            }
        }
    }
}
