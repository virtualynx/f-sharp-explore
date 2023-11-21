<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchLogDukcapil extends Model
{
    use HasFactory;

    protected $table = 'search_logs_dukcapil';

    protected $primaryKey = 'nik';
    
    protected $fillable = [
        'nik',
        'nkk',
        'religion',
        'address',
        'blood_type',
        'gender',
        'occupation',
        'name',
        'father',
        'mother',
        'education',
        'marital',
        'dob',
        'pob',
        'photo_path'
    ];
}
