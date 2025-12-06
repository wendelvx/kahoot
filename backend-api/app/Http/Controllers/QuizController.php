<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuizController extends Controller
{
    use AuthorizesRequests;

    public function start(Request $request)
    {
        $quiz = Quiz::create([
            'user_id' => $request->user()->id,
            'status' => 'in_progress'
        ]);

        $questions = Question::with('options')
            ->inRandomOrder()
            ->limit(10)
            ->get();

        return response()->json([
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    }

    public function finish(Quiz $quiz)
    {
        $this->authorize('update', $quiz);

        $totalCorrect = $quiz->answers()->where('is_correct', true)->count();
        $totalIncorrect = $quiz->answers()->where('is_correct', false)->count();

        $score = $totalCorrect * 10;
        $totalTime = abs($quiz->created_at->diffInSeconds(now()));

        $quiz->update([
            'status' => 'completed',
            'score' => $score,
            'total_correct' => $totalCorrect,
            'total_incorrect' => $totalIncorrect,
            'total_time_seconds' => $totalTime
            
        ]);

        return response()->json([
            'message' => 'Quiz finalizado.',
            'quiz' => $quiz
        ]);
    }
}