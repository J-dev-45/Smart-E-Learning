<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function sendFeedback(Request $request){

        $request->validate([
            'question_id' => 'nullable|integer|exists:questions,id',
            'feedback_message' => 'required|string|min:10|max:1000',
        ]);

        Feedback::create([
            'user_id' => auth()->id(),
            'student_name' => auth()->user()->name,
            'question_id' => $request->question_id,
            'feedback_message' => $request->feedback_message
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Feedback Sent Successfully!'
        ]);

    }
}
