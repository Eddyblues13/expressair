<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            // Sender details
            $table->string('sender_name')->nullable();
            $table->string('sender_address')->nullable();
            $table->string('sender_city')->nullable();
            $table->string('sender_state')->nullable();
            $table->string('sender_zip')->nullable();
            $table->string('sender_country')->nullable();
            $table->string('sender_phone')->nullable();
            $table->string('sender_email')->nullable();

            // Receiver details
            $table->string('receiver_name')->nullable();
            $table->string('receiver_address')->nullable();
            $table->string('receiver_city')->nullable();
            $table->string('receiver_state')->nullable();
            $table->string('receiver_zip')->nullable();
            $table->string('receiver_country')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('receiver_email')->nullable();

            // Package details
            $table->string('tracking_number')->unique();
            $table->text('item_description')->nullable();
            $table->integer('item_quantity')->nullable();
            $table->decimal('declared_value', 12, 2)->nullable();
            $table->decimal('total_weight', 10, 2)->nullable();
            $table->integer('number_of_boxes')->nullable();
            $table->decimal('box_weight', 10, 2)->nullable();

            // Shipping details
            $table->string('shipping_from')->nullable();
            $table->string('shipping_to')->nullable();
            $table->date('shipping_date')->nullable();
            $table->date('estimated_delivery_date')->nullable();


            // Tracking progress
            $table->integer('current_step')->default(1);
            $table->integer('progress_percentage')->default(0);

            // Progress steps
            $table->string('step1_name')->nullable()->default('Initiation');
            $table->date('step1_date')->nullable();
            $table->string('step2_name')->nullable()->default('Verification');
            $table->date('step2_date')->nullable();
            $table->string('step3_name')->nullable()->default('Processing');
            $table->date('step3_date')->nullable();
            $table->string('step4_name')->nullable()->default('Completion');
            $table->date('step4_date')->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
