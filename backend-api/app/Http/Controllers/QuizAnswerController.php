<?php

namespace App\Http\Controllers;

use App\Models\QuizAnswer;
use App\Models\Option;
use Illuminate\Http\Request;

class QuizAnswerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_id' => 'required|exists:questions,id',
            'selected_option_id' => 'required|exists:options,id'
        ]);

        $option = Option::find($request->selected_option_id);

        $answer = QuizAnswer::create([
            'quiz_id' => $request->quiz_id,
            'question_id' => $request->question_id,
            'selected_option_id' => $request->selected_option_id,
            'is_correct' => $option->is_correct
        ]);

        return response()->json($answer);
    }
}