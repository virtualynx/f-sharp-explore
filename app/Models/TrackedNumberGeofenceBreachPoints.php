<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class TrackedNumberGeofenceBreachPoints extends Model
{
    use HasFactory, HasCompositeKey;

    protected $table = 'tracking_number_geo_breach_points';

    protected $primaryKey = ['geo_breach_uuid', 'lat', 'long'];
    
    protected $fillable = [
        'lat',
        'long'
    ];
}
