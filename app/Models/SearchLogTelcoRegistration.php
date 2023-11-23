<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class SearchLogTelcoRegistration extends Model
{
    use HasFactory, HasCompositeKey;

    protected $table = 'search_logs_telco_registration';

    protected $primaryKey = ['msisdn', 'nik'];
    
    protected $fillable = [
        'msisdn',
        'nik',
        'operator'
    ];
}
