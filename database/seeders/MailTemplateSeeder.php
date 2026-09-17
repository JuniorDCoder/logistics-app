<?php

namespace Database\Seeders;

use App\Models\MailTemplate;
use Illuminate\Database\Seeder;

class MailTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'key' => 'shipment_created',
                'name' => 'Shipment Registered',
                'subject' => 'Your Shipment {{tracking_number}} Has Been Registered - {{app_name}}',
                'description' => 'Sent to the sender and receiver as soon as a new shipment is created. '
                    . 'Available placeholders: {{app_name}}, {{recipient_name}}, {{sender_name}}, {{receiver_name}}, '
                    . '{{tracking_number}}, {{status_label}}, {{origin}}, {{destination}}, {{service_type}}, '
                    . '{{estimated_delivery}}, {{tracking_url}}, {{current_date}}.',
                'body' => <<<'HTML'
<p>Dear {{recipient_name}},</p>
<p>Great news! A new shipment has been registered with {{app_name}} under your name.</p>
<table style="width:100%;border-collapse:collapse;margin:16px 0">
<tr><td style="padding:6px 0;color:#6b7280">Tracking Number</td><td style="padding:6px 0;font-weight:600">{{tracking_number}}</td></tr>
<tr><td style="padding:6px 0;color:#6b7280">Current Status</td><td style="padding:6px 0;font-weight:600">{{status_label}}</td></tr>
<tr><td style="padding:6px 0;color:#6b7280">Origin</td><td style="padding:6px 0">{{origin}}</td></tr>
<tr><td style="padding:6px 0;color:#6b7280">Destination</td><td style="padding:6px 0">{{destination}}</td></tr>
<tr><td style="padding:6px 0;color:#6b7280">Service Type</td><td style="padding:6px 0">{{service_type}}</td></tr>
<tr><td style="padding:6px 0;color:#6b7280">Estimated Delivery</td><td style="padding:6px 0">{{estimated_delivery}}</td></tr>
</table>
<p>You can track this shipment at any time using the tracking number above.</p>
<p style="margin-top:24px">Thank you for choosing {{app_name}}.</p>
HTML,
                'is_active' => true,
            ],
            [
                'key' => 'shipment_status_updated',
                'name' => 'Shipment Status Update',
                'subject' => 'Shipment {{tracking_number}} Update: {{status_label}} - {{app_name}}',
                'description' => 'Sent to the sender and receiver whenever a shipment\'s status changes. '
                    . 'Available placeholders: {{app_name}}, {{recipient_name}}, {{sender_name}}, {{receiver_name}}, '
                    . '{{tracking_number}}, {{status_label}}, {{location}}, {{event_description}}, {{origin}}, '
                    . '{{destination}}, {{service_type}}, {{estimated_delivery}}, {{tracking_url}}, {{current_date}}.',
                'body' => <<<'HTML'
<p>Dear {{recipient_name}},</p>
<p>Your shipment <strong>{{tracking_number}}</strong> has a new status update.</p>
<table style="width:100%;border-collapse:collapse;margin:16px 0">
<tr><td style="padding:6px 0;color:#6b7280">New Status</td><td style="padding:6px 0;font-weight:600">{{status_label}}</td></tr>
<tr><td style="padding:6px 0;color:#6b7280">Location</td><td style="padding:6px 0">{{location}}</td></tr>
<tr><td style="padding:6px 0;color:#6b7280">Details</td><td style="padding:6px 0">{{event_description}}</td></tr>
<tr><td style="padding:6px 0;color:#6b7280">Origin</td><td style="padding:6px 0">{{origin}}</td></tr>
<tr><td style="padding:6px 0;color:#6b7280">Destination</td><td style="padding:6px 0">{{destination}}</td></tr>
<tr><td style="padding:6px 0;color:#6b7280">Estimated Delivery</td><td style="padding:6px 0">{{estimated_delivery}}</td></tr>
</table>
<p>You can track this shipment any time using tracking number {{tracking_number}}.</p>
<p style="margin-top:24px">Thank you for choosing {{app_name}}.</p>
HTML,
                'is_active' => true,
            ],
        ];

        foreach ($templates as $template) {
            MailTemplate::updateOrCreate(['key' => $template['key']], $template);
        }
    }
}
