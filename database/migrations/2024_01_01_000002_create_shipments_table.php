<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')->unique();
            $table->string('sender_name');
            $table->string('sender_email')->nullable();
            $table->string('sender_phone')->nullable();
            $table->text('sender_address')->nullable();
            $table->string('receiver_name');
            $table->string('receiver_email')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->text('receiver_address')->nullable();
            $table->string('origin');
            $table->string('destination');
            $table->string('service_type')->default('air_freight');
            $table->decimal('weight', 10, 2)->nullable();
            $table->string('dimensions')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
            $table->date('estimated_delivery')->nullable();
            $table->date('actual_delivery')->nullable();
            $table->text('notes')->nullable();
            $table->integer('package_count')->default(1);
            $table->decimal('declared_value', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
