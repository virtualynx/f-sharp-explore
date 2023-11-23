<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchLogLocateMsisdn extends Model
{
    use HasFactory;

    protected $table = 'search_logs_locate_msisdn';

    protected $primaryKey = 'uuid';
    
    protected $fillable = [
        'msisdn',
        'imei',
        'imsi',
        'phone',
        'lat',
        'long',
        'operator',
        'province',
        'city',
        'district',
        'subdistrict',
    ];
}
