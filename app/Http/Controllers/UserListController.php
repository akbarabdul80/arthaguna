<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->where('is_verified', 1)->orderBy('is_verified', 'asc')->get();

        // dd($users);

        return view('content.user.user_list.index', ['users' => $users]);
    }
}
