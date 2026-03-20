<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number', 'sender_name', 'sender_email', 'sender_phone', 'sender_address',
        'receiver_name', 'receiver_email', 'receiver_phone', 'receiver_address',
        'origin', 'destination', 'service_type', 'weight', 'dimensions',
        'description', 'status', 'estimated_delivery', 'actual_delivery',
        'notes', 'package_count', 'declared_value'
    ];

    protected $casts = [
        'estimated_delivery' => 'date',
        'actual_delivery' => 'date',
    ];

    const STATUSES = [
        'pending'       => 'Pending',
        'picked_up'     => 'Picked Up',
        'in_transit'    => 'In Transit',
        'at_customs'    => 'At Customs',
        'out_for_delivery' => 'Out for Delivery',
        'delivered'     => 'Delivered',
        'returned'      => 'Returned',
        'cancelled'     => 'Cancelled',
    ];

    const SERVICE_TYPES = [
        'air_freight'   => 'Air Freight',
        'ocean_freight' => 'Ocean Freight',
        'road_freight'  => 'Road Freight',
        'express'       => 'Express Delivery',
    ];

    public function trackingEvents()
    {
        return $this->hasMany(TrackingEvent::class)->orderBy('event_time', 'desc');
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'delivered'         => 'success',
            'in_transit'        => 'info',
            'out_for_delivery'  => 'primary',
            'at_customs'        => 'warning',
            'cancelled','returned' => 'danger',
            default             => 'secondary',
        };
    }

    public static function generateTrackingNumber(): string
    {
        $prefix = static::trackingPrefix();

        do {
            $number = $prefix . strtoupper(substr(md5(uniqid((string) mt_rand(), true)), 0, 9));
        } while (static::where('tracking_number', $number)->exists());

        return $number;
    }

    public static function demoTrackingNumber(): string
    {
        return static::trackingPrefix().'DEMO001';
    }

    public static function trackingPrefix(): string
    {
        $cleanName = strtoupper(preg_replace('/[^A-Z0-9]/', '', (string) app_name()));
        $prefix = substr($cleanName, 0, 3);

        return $prefix !== '' ? $prefix : 'ITL';
    }
}
