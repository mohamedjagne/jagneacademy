<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'body',
        'thumbnail',
        'preview',
        'category_id',
        'objectives',
        'user_id'
    ];

    public function section()
    {
        return $this->hasMany(Section::class);
    }

    public function student()
    {
        return $this->belongsToMany(Student::class)->withPivot(['status', 'order_note', 'payment_method']);
    }
}
