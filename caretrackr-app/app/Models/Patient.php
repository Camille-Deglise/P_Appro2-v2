<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
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
        'health_status_id',
        'user_id'

    ] ;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function health_status()
    {
        return $this->belongsTo(HealthStatus::class, 'health_status_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function medications()
    {
        return $this->belongsToMany(Medication::class);
    }

    public function allergies()
    {
        return $this->belongsToMany(Allergy::class);
    }

    public function medical_histories()
    {
        return $this->belongsToMany(MedicalHistory::class);
    }

    public function mesured_values()
    {
        return $this->hasMany(MesuredValue::class);
    }
    
}
