<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrackedNumberGeofence extends Model
{
    use HasFactory;

    protected $table = 'tracking_number_geo';

    protected $primaryKey = 'geo_uuid';
    
    protected $fillable = [
        'msisdn',
        'action',
        'enabled',
        'geojson'
    ];

    public function points(): HasMany
    {
        return $this->hasMany(TrackedNumberGeofencePoints::class, 'geo_uuid', 'geo_uuid');
    }
}
