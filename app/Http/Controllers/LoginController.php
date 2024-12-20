<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LoginController extends Controller
{
    use ValidatesRequests;

    public function showDashboard(){

        $users = User::where('role', 'user')->get()->count();
        $total_deposit = Deposit::where('status', 'approved')->sum('amount');
        $total_withdraw = Withdraw::where('status', 'approved')->sum('amount');


        return view('content.dashboard.dashboards-analytics',['users'=>$users, 'total_deposit'=>$total_deposit, 'total_withdraw'=>$total_withdraw]);
    }

    public function showLoginForm()
    {
        return view('content.auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $validated = $request->validate( [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication passed...
            return redirect()->intended('/');
        }

             // Authentication failed...
            return back()->with('error', 'Login gagal! Periksa email dan password Anda.');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('login');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
