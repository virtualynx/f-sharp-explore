<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class TrackedNumberGeofencePoints extends Model
{
    use HasFactory, HasCompositeKey;

    protected $table = 'tracking_number_geo_points';

    protected $primaryKey = ['geo_uuid', 'lat', 'long'];
    
    protected $fillable = [
        'lat',
        'long'
    ];
}
