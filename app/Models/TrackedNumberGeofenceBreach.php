<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrackedNumberGeofenceBreach extends Model
{
    use HasFactory;

    protected $table = 'tracking_number_geo_breach';

    protected $primaryKey = 'geo_breach_uuid';
    
    protected $fillable = [
        'msisdn',
        'action',
        'geojson'
    ];

    public function points(): HasMany
    {
        return $this->hasMany(TrackedNumberGeofenceBreachPoints::class, 'geo_breach_uuid', 'geo_breach_uuid');
    }
}
