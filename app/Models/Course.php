<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
      protected $table ='courses';
      
    protected $fillable = [
        'category_id',
        'title',
        'price',
        'capacity',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public $timestamps = false;
}
