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

    //id nya milik user
    //user_id milik rentlog

    // return $this->hasOne(User::class, 'id',  'user_id');
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id',  'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
