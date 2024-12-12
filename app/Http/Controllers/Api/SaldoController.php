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
        return BaseResponse::success('Saldo user', $user->total_saldo);
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

        if ($user->is_verified == 0) {
            return BaseResponse::error('User belum terverifikasi', 400);
        }

        if ($user->total_saldo < $request->amount) {
            return BaseResponse::error('Saldo tidak cukup', 400);
        }

        $user->withdraws()->create([
            'amount' => $request->amount,
            'withdraw_nama_bank' => $user->nama_bank,
            'withdraw_nama_pemilik' => $user->nama_pemilik,
            'withdraw_no_rekening' => $user->no_rekening,
        ]);

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
