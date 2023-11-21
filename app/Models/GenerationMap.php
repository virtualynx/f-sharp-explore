<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerationMap extends Model
{
    use HasFactory;

    protected $table = 'generation_map';

    protected $primaryKey = 'gen_id';

    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'lowerbound',
        'upperbound'
    ];
}
