<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_name',
        'sender_address',
        'sender_city',
        'sender_state',
        'sender_zip',
        'sender_country',
        'sender_phone',
        'sender_email',
        'receiver_name',
        'receiver_address',
        'receiver_city',
        'receiver_state',
        'receiver_zip',
        'receiver_country',
        'receiver_phone',
        'receiver_email',
        'tracking_number',
        'item_description',
        'item_quantity',
        'declared_value',
        'total_weight',
        'number_of_boxes',
        'box_weight',
        'shipping_from',
        'shipping_to',
        'shipping_date',
        'estimated_delivery_date',
        'current_step',
        'progress_percentage',
        'step1_name',
        'step1_date',
        'step2_name',
        'step2_date',
        'step3_name',
        'step3_date',
        'step4_name',
        'step4_date',
        'notes'
    ];

    protected $dates = [
        'shipping_date',
        'estimated_delivery_date',
        'step1_date',
        'step2_date',
        'step3_date',
        'step4_date',
        'created_at',
        'updated_at'
    ];
    // app/Models/Package.php

    public function trackingLocations()
    {
        return $this->hasMany(TrackingLocation::class);
    }

    public function updateProgress($step)
    {
        $this->current_step = $step;
        $this->progress_percentage = $step * 25;

        $stepDateField = "step{$step}_date";
        if (empty($this->$stepDateField)) {
            $this->$stepDateField = now();
        }

        $this->save();
    }
}
