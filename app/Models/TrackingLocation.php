<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrackingLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'location_name',
        'status',
        'arrival_time',
        'is_current',
    ];


    protected $casts = [
        'arrival_time' => 'datetime',
    ];


    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
