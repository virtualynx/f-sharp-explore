<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrackedNumber extends Model
{
    use HasFactory;

    protected $table = 'tracking_number_jobs';

    protected $primaryKey = 'msisdn';
    
    protected $fillable = [
        'msisdn',
        'name',
        'group',
        'cron_minute',
        'cron_hour',
        'cron_dayofmonth',
        'cron_month',
        'cron_dayofweek'
    ];

    public function logs(): HasMany
    {
        return $this->hasMany(TrackedNumberLog::class, 'msisdn', 'msisdn');
    }
}
