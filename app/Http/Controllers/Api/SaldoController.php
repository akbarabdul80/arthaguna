<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WithdrawRequest;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    public function getSaldo(Request $request)
    {
        $user = $request->user();

        $total_saldo = $user->total_saldo;

        $withdraw_today = $user->withdraws()->whereDate('created_at', now())
        ->where('status', 'approved')
        ->sum('amount');

        $deposit_today = $user->deposits()->whereDate('created_at', now())
        ->where('status', 'approved')
        ->sum('amount');

        $growth_saldo = $deposit_today - $withdraw_today;
        $growth_percent = 0;
        if ($total_saldo != 0) {
            $growth_percent = $growth_saldo / $total_saldo * 100;
        }

        $data = [
            'total_saldo' => $total_saldo,
            'withdraw_today' => $withdraw_today,
            'deposit_today' => $deposit_today,
            'growth_saldo' => $growth_saldo,
            'growth_percent' => $growth_percent
        ];


        return BaseResponse::success('Saldo user', $data);
    }

    public function deposit(Request $request)
    {
        $user = $request->user();

        if ($user->is_verified == 0) {
            return BaseResponse::error('User belum terverifikasi', 400);
        }

        $user->deposit()->create([
            'amount' => $request->amount
        ]);

        $user->total_saldo += $request->amount;
        $user->save();

        return BaseResponse::success('Deposit success', $user->total_saldo);
    }

    public function withdraw(WithdrawRequest $request)
    {
        $user = $request->user();

        if ($user->total_saldo < $request->amount) {
            return BaseResponse::error('Saldo tidak cukup', 400);
        }

        $invoice_number = 'WD-' . time() . '-' . $user->id;

        $user->withdraws()->create([
            'invoice_number' => $invoice_number,
            'amount' => $request->amount,
            'withdraw_nama_bank' => $user->nama_bank,
            'withdraw_nama_pemilik' => $user->nama_pemilik,
            'withdraw_no_rekening' => $user->no_rekening,
        ]);

        $user->total_saldo -= $request->amount;

        $user->save();

        return BaseResponse::success('Withdraw success', $user->total_saldo);
    }

    public function getDepositWithdraw(Request $request)
    {
        $user = $request->user();
        $deposit = $user->deposit;
        $withdraw = $user->withdraw;

        return BaseResponse::success('Deposit withdraw user', [
            'deposit' => $deposit,
            'withdraw' => $withdraw
        ]);
    }

}
