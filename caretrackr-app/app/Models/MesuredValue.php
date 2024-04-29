<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MesuredValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'temperature',
        'systole',
        'diastole',
        'oxygen_saturation',
        'pulse',
        'bloog_sugar',
        'mesured_at',
        'patient_id'
    ];

    public function patients()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
