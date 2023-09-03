<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'region',
        'address',
        'phone',
        'user_id'
    ];

    public function course()
    {
        return $this->belongsToMany(Course::class)->withPivot(['status', 'order_note', 'payment_method']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
