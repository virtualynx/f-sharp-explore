<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackedNumberLog extends Model
{
    use HasFactory;

    protected $table = 'tracking_number_logs';

    protected $primaryKey = 'uuid';
    
    protected $fillable = [
        'msisdn',
        'lat',
        'long',
        'success',
        'error_message'
    ];

    // public function tracked_number()
    // {
    //     return $this->belongsTo(TrackedNumber::class, 'msisdn', 'msisdn');
    // }
}
