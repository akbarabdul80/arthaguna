<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdraw extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'withdraws';

    protected $fillable = [
        'invoice_number',
        'user_id',
        'amount',
        'withdraw_nama_bank',
        'withdraw_nama_pemilik',
        'withdraw_no_rekening',
        'midtrans_transaction_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
