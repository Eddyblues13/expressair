<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\TrackingLocation;
use Carbon\Carbon;

class TrackingLocationSeeder extends Seeder
{
    public function run()
    {
        // Fetch the first package, or create one for testing
        $package = Package::first() ?? Package::factory()->create([
            'tracking_number' => 'PKG123456789',
            'sender_name' => 'John Doe',
            'receiver_name' => 'Jane Smith',
            'shipping_from' => 'New York',
            'shipping_to' => 'San Francisco',
        ]);

        // Example locations
        $locations = [
            [
                'location_name' => 'New York',
                'arrival_time' => Carbon::now()->subDays(3),
                'status' => 'Dispatched',
                'is_current' => false,
            ],
            [
                'location_name' => 'Chicago',
                'arrival_time' => Carbon::now()->subDays(2),
                'status' => 'In Transit',
                'is_current' => false,
            ],
            [
                'location_name' => 'Denver',
                'arrival_time' => Carbon::now()->subDay(),
                'status' => 'Arrived at Facility',
                'is_current' => true, // Mark current location
            ],
            [
                'location_name' => 'San Francisco',
                'arrival_time' => null,
                'status' => 'Est. Delivery: ' . Carbon::now()->addDays(2)->format('M d'),
                'is_current' => false,
            ],
        ];

        foreach ($locations as $loc) {
            TrackingLocation::create([
                'package_id' => $package->id,
                'location_name' => $loc['location_name'],
                'arrival_time' => $loc['arrival_time'],
                'status' => $loc['status'],
                'is_current' => $loc['is_current'],
            ]);
        }
    }
}
