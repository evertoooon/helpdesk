<?php

use App\Http\Controllers\Api\TicketApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Request $request) {
    $validated = $request->validate([
        'email' => 'required|email|max:255',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $validated['email'])->first();

    if (!$user || !Hash::check($validated['password'], $user->password)) {
        return response()->json([
            'success' => false,
            'message' => 'E-mail ou senha inválidos.',
        ], 401);
    }

    $token = $user
        ->createToken('helpdesk-token')
        ->plainTextToken;

    return response()->json([
        'success' => true,
        'message' => 'Login realizado com sucesso.',
        'token' => $token,
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ],
    ]);
})->name('api.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
        ]);
    })->name('api.user');

    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout realizado com sucesso.',
        ]);
    })->name('api.logout');

    Route::get('/tickets', [TicketApiController::class, 'index'])
        ->name('api.tickets.index');

    Route::get('/tickets/{ticket}', [TicketApiController::class, 'show'])
        ->name('api.tickets.show');

    Route::post('/tickets', [TicketApiController::class, 'store'])
        ->name('api.tickets.store');

    Route::put('/tickets/{ticket}', [TicketApiController::class, 'update'])
        ->name('api.tickets.update');

    Route::delete('/tickets/{ticket}', [TicketApiController::class, 'destroy'])
        ->name('api.tickets.destroy');

    Route::post('/tickets/{ticket}/comments', [TicketApiController::class, 'comment'])
        ->name('api.tickets.comment');
});