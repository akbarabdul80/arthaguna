<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'deposits';

    protected $fillable = [
        'user_id',
        'amount',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
