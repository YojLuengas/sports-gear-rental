<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id',
        'student_name',
        'year_level',
        'rental_date',
        'returned_date',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
