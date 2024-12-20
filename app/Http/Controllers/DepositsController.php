<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositsController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with([
            'user' => function ($query) {
                $query->select('id', 'name', 'nama_pemilik');
            },
        ])->get();

        // dd($deposits);

        return view('content.deposit.index', ['deposits' => $deposits]);
    }

    public function update(Request $request, $id)
    {
        $deposit = Deposit::findOrFail($id);

        if ($request->status == 'pending' or $request->status == 'approved' or $request->status == 'rejected') {
            $deposit->status = $request->status;
        }

        return redirect()->route('deposit');
    }
}
