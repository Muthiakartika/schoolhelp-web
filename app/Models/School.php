<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'schoolName',
        'schoolAddress',
        'schoolCity'
    ];

    public function schoolAdmin(){
        return $this->hasMany(schoolAdmins::class, 'schoolID');
    }
}
