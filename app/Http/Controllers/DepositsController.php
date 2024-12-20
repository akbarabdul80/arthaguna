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

        return view('content.deposit.index', ['deposits' => $deposits]);
    }
}
