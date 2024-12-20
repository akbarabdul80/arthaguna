<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;


class WithdrawalController extends Controller
{
    public function index(){
        $withdrawal = Withdraw::all();

        return view('content.withdrawal.index', ['withdrawal' => $withdrawal]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Cari data withdrawal berdasarkan ID
        $withdrawal = Withdraw::findOrFail($id);

        // Update status
        $withdrawal->status = $validatedData['status'];
        $withdrawal->save();

        // Redirect dengan pesan sukses
        return redirect()->route('withdrawal')->with('success', 'Withdrawal status updated successfully.');
    }

}
