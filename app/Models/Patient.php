<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name','birth_date','phone','address'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
