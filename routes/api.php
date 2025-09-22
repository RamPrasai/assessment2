<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Http\Controllers\Api\PostController;

// POST /api/login -> returns { token }
Route::get('/health', function () {
    try {
        DB::select('select 1');
        $tokens = Schema::hasTable('personal_access_tokens');
        $users  = \App\Models\User::count();
        return response()->json([
            'ok' => true,
            'db' => 'up',
            'tokens_table' => $tokens,
            'users' => $users,
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'ok' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
});

Route::post('/login', function (Request $request) {
    $data = $request->validate([
        'email' => ['required','email'],
        'password' => ['required'],
    ]);

    $user = User::where('email', $data['email'])->first();

    if (!$user || !Hash::check($data['password'], $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return ['token' => $user->createToken('api')->plainTextToken];
});

// Protected posts CRUD via Sanctum token
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
});
