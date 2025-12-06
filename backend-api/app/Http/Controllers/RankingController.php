<?php

namespace App\Http\Controllers;

use App\Models\Quiz;

class RankingController extends Controller
{
    public function index()
    {
        $ranking = Quiz::with('user')
            ->where('status', 'completed')
            ->orderByDesc('score')
            ->orderBy('total_time_seconds')
            ->take(50) // top 50
            ->get();

        return response()->json($ranking);
    }
}