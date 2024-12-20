<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserRegistraionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'user')
        ->whereIn('is_verified', [0, 2])
        ->orderBy('is_verified', 'asc')
        ->get();

        return view('content.user.registration.index', ['users' => $users]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'is_verified' => 'required|in:0,1,2',
        ]);

        // Cari data withdrawal berdasarkan ID
        $user = User::findOrFail($id);

        // Update status
        $user->is_verified = $validatedData['is_verified'];
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('user.reg')->with('success', 'User Registration status updated successfully.');
    }
}
