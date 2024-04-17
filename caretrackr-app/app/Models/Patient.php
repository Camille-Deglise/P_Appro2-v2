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

    ] ;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function health_status()
    {
        return $this->belongsTo(Health_Status::class);
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

    public function medical_background()
    {
        return $this->belongsToMany(Medical_Background::class);
    }

    public function mesured_values()
    {
        return $this->hasMany(Mesured_Value::class);
    }
    
}
