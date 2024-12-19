<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TmpMidtrans extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tmp_midtrans';

    protected $fillable = [
        'invoice_number',
        'user_id',
        'amount',
        'midtrans_transaction_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
