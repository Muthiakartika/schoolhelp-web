<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schoolAdmins extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullname',
        'schoolID',
        'position'
    ];

    public function school(){
        return $this->belongsTo(School::class, 'id');
    }
}
