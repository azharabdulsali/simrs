<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['name','specialty','phone'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
