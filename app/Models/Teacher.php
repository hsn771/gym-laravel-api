<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
      protected $table ='teacher';
      
    protected $fillable = [
        'tname',
        'tpost',
        'timage',
    ];

     public $timestamps = false;

    public function getTimageAttribute($value)
    {
        return $value ? url('/' . $value) : null;
    }
}
