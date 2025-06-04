<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PackageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('packages')->insert([
                // Sender details
                'sender_name' => $faker->name,
                'sender_address' => $faker->address,
                'sender_city' => $faker->city,
                'sender_state' => $faker->state,
                'sender_zip' => $faker->postcode,
                'sender_country' => $faker->country,
                'sender_phone' => $faker->phoneNumber,
                'sender_email' => $faker->safeEmail,

                // Receiver details
                'receiver_name' => $faker->name,
                'receiver_address' => $faker->address,
                'receiver_city' => $faker->city,
                'receiver_state' => $faker->state,
                'receiver_zip' => $faker->postcode,
                'receiver_country' => $faker->country,
                'receiver_phone' => $faker->phoneNumber,
                'receiver_email' => $faker->safeEmail,

                // Package details
                'tracking_number' => strtoupper(Str::random(10)),
                'item_description' => $faker->sentence,
                'item_quantity' => $faker->numberBetween(1, 10),
                'declared_value' => $faker->randomFloat(2, 50, 500),
                'total_weight' => $faker->randomFloat(2, 1, 20),
                'number_of_boxes' => $faker->numberBetween(1, 5),
                'box_weight' => $faker->randomFloat(2, 0.5, 5),

                // Shipping details
                'shipping_from' => $faker->city,
                'shipping_to' => $faker->city,
                'shipping_date' => $faker->date(),
                'estimated_delivery_date' => $faker->date(),

                // Tracking progress
                'current_step' => $faker->numberBetween(1, 4),
                'progress_percentage' => $faker->numberBetween(0, 100),

                // Steps
                'step1_name' => 'Initiation',
                'step1_date' => $faker->date(),
                'step2_name' => 'Verification',
                'step2_date' => $faker->date(),
                'step3_name' => 'Processing',
                'step3_date' => $faker->date(),
                'step4_name' => 'Completion',
                'step4_date' => $faker->date(),

                // Notes and timestamps
                'notes' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
