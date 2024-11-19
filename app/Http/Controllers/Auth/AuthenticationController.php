<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request) {
        // Mencatat informasi permintaan pendaftaran
        Log::info('Register Request: ', $request->all()); 

        // Validasi data permintaan
        try {
            $validatedData = $request->validated();
            Log::info('Validated Data: ', $validatedData); 

            $userData = [
                'name' => $validatedData['name'],
                'phone_number' => $validatedData['phone_number'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ];

            $user = User::create($userData);
            
            // Mengembalikan respons tanpa token
            return response([
                'user' => $user,
                'message' => 'Registration successful, please log in to obtain your token.'
            ], 201);
        } catch (\Exception $e) {
            Log::error('Registration Error: ', [
                'message' => $e->getMessage(),
                'request' => $request->all()
            ]);
            return response()->json(['message' => 'Registration failed: ' . $e->getMessage()], 422);
        }
    }

    public function login(LoginRequest $request)
    {
        Log::info('Login Request: ', $request->all()); // Mencatat informasi permintaan login

        // Validasi data permintaan
        try {
            $validatedData = $request->validated();
            Log::info('Validated Data: ', $validatedData); // Menampilkan data yang sudah divalidasi

            $user = User::whereEmail($validatedData['email'])->first();

            if (!$user || !Hash::check($validatedData['password'], $user->password)) {
                Log::warning('Invalid Credentials: ', $validatedData);
                return response([
                    'message' => 'Invalid credentials'
                ], 422);
            }

            // Membuat token saat login
            $token = $user->createToken('kas_v.0.0.1_api')->plainTextToken;

            return response([
                'user' => $user,
                'token' => $token
            ], 200);
        } catch (\Exception $e) {
            Log::error('Login Error: ', [
                'message' => $e->getMessage(),
                'request' => $request->all()
            ]);
            return response()->json(['message' => 'Login failed: ' . $e->getMessage()], 422);
        }
    }

    public function logout(LogoutRequest $request)
    {
        try {
            // Mendapatkan token yang digunakan oleh pengguna saat ini
            $user = $request->user();
            $currentToken = $request->user()->currentAccessToken();

            // Menghapus hanya token yang sedang digunakan oleh pengguna
            $currentToken->delete();

            Log::info('User Logged Out: ', ['user_id' => $user->id]);

            return response()->json(['message' => 'Logout successful'], 200);
        } catch (\Exception $e) {
            Log::error('Logout Error: ', [
                'message' => $e->getMessage(),
                'request' => $request->all()
            ]);
            return response()->json(['message' => 'Logout failed: ' . $e->getMessage()], 422);
        }
    }
}
 