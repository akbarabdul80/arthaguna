<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Responses\BaseResponse;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        $data['total_saldo'] = 0;
        $image_ktp = $request->file('ktp_image');

        if ($image_ktp) {
            $image_path = $image_ktp->store('image_ktp', 'public');
            $data['ktp_image'] = $image_path;
        }

        $user = User::create($data);

        if (!$user) {
            DB::rollBack();
            return BaseResponse::error('Failed to create user', 500);
        }

        DB::commit();

        return BaseResponse::success('User created', $user);
    }


    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return BaseResponse::errorForbidden("Silahkan cek kembali email dan password anda");
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return BaseResponse::success('Login success', [
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
}
