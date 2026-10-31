<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\User;
use App\Services\MailerService;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function sendFeedback(Request $request){

        $request->validate([
            'question_id' => 'nullable|uuid|exists:questions,id',
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


    public function sendFeedbackReply(Request $request, MailerService $mailerService)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'integer', 'exists:users,id'],
            'feedback_id' => ['required', 'integer', 'exists:feedback,id'],
            'question_label' => ['nullable', 'string', 'max:1000'],
            'reply_message' => ['required', 'string', 'min:10', 'max:1000'],
        ]);

        $student = User::findOrFail($validated['student_id']);
        $feedback = Feedback::findOrFail($validated['feedback_id']);

        $feedback->update([
            'replied_by' => auth()->user()->name,
            'reply_message' => $validated['reply_message'],
            'status' => 'Done',
        ]);

        $emailSent = false;

        if ($student->email && filter_var($student->email, FILTER_VALIDATE_EMAIL)) {
            $emailSent = $mailerService->sendFeedbackMail(
                $student->email,
                $feedback->student_name,
                $feedback->feedback_message,
                $validated['reply_message'],
                $validated['question_label'] ?? null
            );
        }

        return response()->json([
            'success' => true,
            'email_sent' => $emailSent,
            'message' => $emailSent
                ? 'Reply saved and email sent successfully.'
                : 'Reply saved, but the email could not be sent.',
            'reply' => [
                'replied_by' => auth()->user()->name,
            ],
        ]);
    }
}
