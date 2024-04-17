<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_Background extends Model
{
    use HasFactory;

    protected $fillable = ['label'];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
