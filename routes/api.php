<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Api\TicketApiController;

Route::post('/login', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {

        return response()->json([
            'success' => false,
            'message' => 'E-mail ou senha inválidos.'
        ], 401);

    }

    $user = User::where(
        'email',
        $request->email
    )->first();

    $token = $user->createToken(
        'helpdesk-token'
    )->plainTextToken;

    return response()->json([
        'success' => true,
        'message' => 'Login realizado com sucesso.',
        'token' => $token,
        'user' => $user
    ]);

});


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/tickets', [TicketApiController::class, 'index']);

    Route::get('/tickets/{ticket}', [TicketApiController::class, 'show']);

    Route::post('/tickets', [TicketApiController::class, 'store']);

    Route::put('/tickets/{ticket}', [TicketApiController::class, 'update']);

    Route::delete('/tickets/{ticket}', [TicketApiController::class, 'destroy']);

    Route::post('/tickets/{ticket}/comments', [TicketApiController::class, 'comment']);

});