<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentLogs extends Model
{
    use HasFactory;
    protected $table = 'rent_logs';
    protected $fillable = [
        'book_id',
        'user_id',
        'rent_date',
        'return_date'
    ];
}
