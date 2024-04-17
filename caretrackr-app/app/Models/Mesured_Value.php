<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesured_Value extends Model
{
    use HasFactory;
    protected $fillable = [
        'temperature',
        'systole',
        'diastole',
        'oxygen_saturation',
        'pulse',
        'bloog_sugar',
        'mesure_at',
    ];

    public function patients()
    {
        return $this->belongsTo(Patient::class);
    }
}
