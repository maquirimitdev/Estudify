<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'contact_number', 'address', 'date_of_birth'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Parent::class);
    }

    public function getAge(): int
    {
        return $this->date_of_birth->diffInYears(now());
    }
}
