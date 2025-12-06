<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizAnswerController;
use App\Http\Controllers\RankingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/ranking', [RankingController::class, 'index']);

Route::post('/dev/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        // Cria um token simples
        $token = $user->createToken('TestToken')->plainTextToken;
        
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    return response()->json(['message' => 'Login falhou'], 401);
});

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/quizzes/start', [QuizController::class, 'start']);

    Route::post('/answers', [QuizAnswerController::class, 'store']);

    Route::post('/quizzes/{quiz}/finish', [QuizController::class, 'finish']);

    Route::get('/user', function () {
        return auth()->user();
    });

    
});

