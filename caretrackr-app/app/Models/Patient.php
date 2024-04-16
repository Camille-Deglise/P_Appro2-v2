<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'firstname',
        'birth_date',
        'gender',
        'insurance',
        'road',
        'road_number',
        'npa',
        'avs_number',
        'city',
        'country',
        'health_status',
        'user_id',

    ] ;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function health_status()
    {
        return $this->belongsTo(Health_Status::class);
    }

    
}
