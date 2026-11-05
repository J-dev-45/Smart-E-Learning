<?php

use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuestionImportController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResendOTP;
use App\Http\Controllers\Auth\VerifyOTPController;
use App\Http\Controllers\Client\AssessmentController;
use App\Http\Controllers\Client\CodePretestController;
use App\Http\Controllers\Client\CodeQuizController;
use App\Http\Controllers\Client\CodeRunnerController;
use App\Http\Controllers\Client\LearnController;
use App\Http\Controllers\Client\Pretest;
use App\Http\Controllers\Client\ProfileAvatarController;
use App\Models\AnsweredAssessmentQuestions;
use App\Models\AnsweredModuleQuestions;
use App\Models\Feedback;
use App\Models\Leaderboard;
use App\Models\ModuleQuiz;
use App\Models\Modules;
use App\Models\Questions;
use App\Models\RecentActivity;
use App\Models\SubjectProgress;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Support\Facades\Route;





Route::middleware(['guest'])->group(function(){
    Route::get('/', function(){
        return view('Auth.Login');
    })->name('login');

    Route::get('/register', function(){
        return view('Auth.Register');
    })->name('register');

    Route::get('/account_verification', function(){

        $otp_session = session('otp_session');
        
        if(!$otp_session){
            return redirect()->route('login');
        }

        $email = User::where('id', $otp_session['user_id'])->value('email');
        return view('Auth.Account_Verification', compact('email'));
    })->name('account_verification');


    Route::post('/login',[LoginController::class, 'login'])->middleware('throttle:3,1');
    Route::post('/register', [RegisterController::class, 'register'])->middleware('throttle:3,1');
    Route::post('/verify_otp', [VerifyOTPController::class, 'verify'])
    ->middleware('throttle:otp-verify');

    Route::get('/otp/resend-status', [ResendOTP::class, 'status'])
        ->middleware('throttle:30,1');

    Route::post('/resend_otp', [ResendOTP::class, 'resend'])
        ->middleware('throttle:10,1');

    Route::get('/forgot-password', function () {
        return view('Auth.Forgot_Password');
    })->name('forgot.password');

    Route::post('/forgot-password/send-otp', [ForgotPasswordController::class, 'sendResetOtp'])
        ->middleware('throttle:3,1'); 

    Route::post('/forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyResetOtp'])
        ->middleware('throttle:5,1');

    Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])
        ->middleware('throttle:3,1');

});





// CLIENT ------------------------------------------------------------------------------------------------------------------------------------------------
// CLIENT ------------------------------------------------------------------------------------------------------------------------------------------------
// CLIENT ------------------------------------------------------------------------------------------------------------------------------------------------
Route::middleware(['auth'])->group(function(){

    // ===========================================================
    // ===========================================================
    Route::get('/home', function () {
        $subjects = Subjects::orderBy('order', 'asc')->get();
        $modules = Modules::all();
        $module_pretests = ModuleQuiz::where('user_id', auth()->user()->id)->get();

        $subjects_progress = SubjectProgress::where('user_id', auth()->id())->get();
        $completed_subjects = $subjects_progress->where('progress', '>=', 100)
            ->where('has_passed', true)
            ->count();

        $user_leaderboard = Leaderboard::where('user_id', auth()->id())->exists();

        if(!$user_leaderboard){
            Leaderboard::create([
                'user_id' => auth()->id(),
            ]);
        }

        
        $leaderboard = Leaderboard::where('points', '>', 0)
            ->orderBy('points', 'DESC')
            ->take(20)
            ->get();

        
        $users = User::whereIn('id', $leaderboard->pluck('user_id'))
            ->select('id', 'name', 'profile_color', 'profile_picture', 'profile_avatar')
            ->get()
            ->keyBy('id')
            ->map(function ($user) {
                if ($user->profile_picture && str_starts_with($user->profile_picture, 'profiles/')) {
                    $user->profile_picture = rtrim(config('services.supabase.url'), '/')
                        . '/storage/v1/object/public/'
                        . config('services.supabase.avatar_bucket', 'pictures')
                        . '/'
                        . $user->profile_picture;
                }

                if ($user->profile_avatar) {
                    $user->profile_avatar = asset(ltrim($user->profile_avatar, '/'));
                }

                return $user;
        });

        $subjects_passed_ids = SubjectProgress::where('user_id', auth()->id())
            ->where('has_passed', true)
            ->pluck('subject_id');

        $answered_assessment_questions_exam = AnsweredAssessmentQuestions::where('user_id', auth()->id())
            ->whereIn('subject_id', $subjects_passed_ids)
            ->where('type_of_assessment', 'exam')
            ->get();

        $modules_passed_ids = ModuleQuiz::where('user_id', auth()->id())
            ->where('has_passed', true)
            ->pluck('module_id');

        $answered_assessment_questions = AnsweredAssessmentQuestions::where('user_id', auth()->id())->get();

        $answered_assessment_questions_quiz = AnsweredAssessmentQuestions::where('user_id', auth()->id())
            ->whereIn('module_id', $modules_passed_ids)
            ->where('type_of_assessment', 'quiz')
            ->get();
        

        $total_answered_assessment = $answered_assessment_questions_exam->count() + $answered_assessment_questions_quiz->count();
        $total_quizzes_score =  $answered_assessment_questions_quiz->where('is_correct', true)->count() ?? 0;
        $total_exams_score = $answered_assessment_questions_exam->where('is_correct', true)->count() ?? 0;

        $total_assessment_score = $total_quizzes_score + $total_exams_score;

        // $total_assessment_score = $answered_assessment_questions->where('is_correct', true)->count();
        $answered_module_questions = AnsweredModuleQuestions::where('user_id', auth()->id())->get();
        $activity_score = 0;
        foreach($answered_module_questions as $amq){
            if(strtolower($amq->user_answer) === strtolower($amq->correct_answer)){
                $activity_score++;
            }
        }

        $total_answered = $total_answered_assessment + $answered_module_questions->count();
        $total_score = $total_assessment_score + $activity_score;

        $accuracy = $total_answered > 0
            ? round(($total_score / $total_answered) * 100)
            : 0;

        
        return view('Client.Pages.Home', compact(
            'subjects',
            'modules',
            'module_pretests',
            'leaderboard',
            'users',
            'subjects_progress',
            'total_score',
            'accuracy',
            'completed_subjects'
        ));
    })->name('home');


    // ===========================================================
    // ===========================================================

    Route::post('/profile/avatar', [
        ProfileAvatarController::class,
        'update'
    ])->name('profile.avatar.update');

    Route::post('/profile/avatar/preset', [
        ProfileAvatarController::class,
        'savePreset'
    ])->name('profile.avatar.preset');

    Route::get('/learn/{subject_name}/{subject_id}', [LearnController::class, 'learn']);
    Route::get('/learning/{subject_name}/{subject_id}/{module_name}/{module_id}', [LearnController::class, 'learnModule']);
    Route::put('/module-progress', [LearnController::class, 'scrollModuleProgress']);
    Route::post('/submit-module-activity', [LearnController::class, 'submitModuleActivity']);

    Route::post('/retake-activity', [LearnController::class, 'retakeActivity']);
    Route::post('/retake-assessment', [AssessmentController::class, 'retakeAssessment']);

    Route::post('/sendFeedback', [FeedbackController::class, 'sendFeedback'])->middleware('throttle:3,1');

    
    Route::post('/submit-unanswered', [AssessmentController::class, 'submitUnanswered']);
    Route::get('/result/{type_of_assessment}/{type}/{subject_name}/{subject_id}/{module_name}/{module_id}', [AssessmentController::class, 'resultPage'])->name('assessment.result');

    Route::post('/submitAnswer', [AssessmentController::class, 'submitAnswer']);
    Route::post('/submitCode', [CodePretestController::class, 'submitCodeAnswer']);

    // CODE RUNNER (moved inside auth so only logged-in students can use your compiler quota)
    Route::post('/run-code', [CodeRunnerController::class, 'run'])
        ->middleware('throttle:20,1');

    // CODE QUIZ
    Route::get('/code-quiz/{question}', [CodeQuizController::class, 'show']);
    Route::post('/code-quiz/{question}/check', [CodeQuizController::class, 'check'])
        ->middleware('throttle:10,1');

    // CODE QUIZ TEST PAGE (local environment only, never registered in production)
    if (app()->environment('local')) {
        Route::get('/test/code-quiz/{question}', function (Questions $question) {
            return view('test.code-quiz', [
                'question' => $question,
                'total'    => $question->testCases()->count(),
                'hidden'   => $question->testCases()->where('is_hidden', true)->count(),
            ]);
        });
    }

    Route::get('/pretest/{subject_name}/{subject_id}', [Pretest::class, 'pretestModules']);
    Route::get('/assessment/{type_of_assessment}/{to_take}/{subject_name}/{subject_id}/{module_name}/{module_id}', [AssessmentController::class, 'taking_assessment'])->name('assessment.taking');

    Route::put('/change-password', [PasswordController::class, 'changePassword']);
    Route::post('/logout_student', [LogoutController::class, 'logout']);

});




// ADMIN ------------------------------------------------------------------------------------------------------------------------------------------------
// ADMIN ------------------------------------------------------------------------------------------------------------------------------------------------
// ADMIN ------------------------------------------------------------------------------------------------------------------------------------------------
// ADMIN ------------------------------------------------------------------------------------------------------------------------------------------------
Route::middleware(['auth','Admin'])->group(function(){
    // ===========================================================
    // ===========================================================
    Route::get('/dashboard', function(){
        $total_users = User::count();
        $total_admins = User::where('role', 'Admin')->count();
        $total_subjects = Subjects::count();
        $recent_activities = RecentActivity::orderBy('created_at', 'DESC')->get();

        $leaderboard = Leaderboard::where('points', '>', 0)
            ->orderBy('points', 'DESC')
            ->take(20)
            ->get();

        $users = User::whereIn('id', $leaderboard->pluck('user_id'))->select('id','name','profile_color', 'profile_picture', 'profile_avatar')->get();

        $total_feedbacks = Feedback::count();

        return view('Admin.Pages.Dashboard', compact(
            'total_users',
            'total_admins',
            'total_subjects',
            'recent_activities',
            'leaderboard',
            'users',
            'total_feedbacks'
        ));
    })->name('dashboard_page');

    // ===========================================================
    // ===========================================================
    Route::get('/users', function(){
        $users = User::select('id','id_number', 'name', 'email','role', 'status','profile_color', 'profile_picture', 'profile_avatar')->get();
        return view('Admin.Pages.Users', compact(
            'users'
        ));
    })->name('users_page');

    // ===========================================================
    // ===========================================================
    Route::get('/subjects', function(){

        $subjects = Subjects::select('id', 'subject_name', 'subject_code', 'pre_requisite as prerequisite_id','slug', 'order')
            ->orderBy('order', 'asc')
            ->get();
        $modules = Modules::select( 'id', 'order', 'subject_id', 'module_name' )
        ->orderBy('subject_id')
        ->orderBy('order', 'asc')
        ->get();

        return view('Admin.Pages.Subjects', compact(
            'subjects',
            'modules',
        ));
    })->name('subjects_page');

    // ===========================================================
    // ===========================================================
    Route::get('/feedbacks', function(){

        $feedbacks = Feedback::select('id', 'user_id', 'student_name', 'feedback_message', 'question_id', 'replied_by', 'reply_message', 'status', 'created_at', 'updated_at')
            ->get();
        $users = User::whereIn('id', $feedbacks->pluck('user_id'))
            ->select('id', 'profile_color', 'profile_avatar', 'profile_picture')
            ->get();
        $questions = Questions::whereIn('id', $feedbacks->pluck('question_id'))->get();

        $total_feedbacks = $feedbacks->count();
        $total_new_feedbacks = $feedbacks->where('status', 'New')->count();
        $total_done_feedbacks = $feedbacks->where('status', 'Done')->count();
        return view('Admin.Pages.Feedbacks', compact(
            'feedbacks',
            'questions',
            'total_feedbacks',
            'total_new_feedbacks',
            'total_done_feedbacks',
            'users'
        ));
    })->name('feedbacks_page');



    // ===========================================================
    // ===========================================================

    // USERS
    Route::put('/promoteUser', [UserController::class, 'promoteUser']);
    Route::put('/demoteUser', [UserController::class, 'demoteUser']);
    Route::delete('/deleteUser', [UserController::class, 'deleteUser']);

    // FEEDBACKS
    Route::post('/sendReply', [FeedbackController::class, 'sendFeedbackReply']);
    Route::delete('/deleteFeedback', [FeedbackController::class, 'deleteFeedback']);


    // SUBJECTS
    Route::get('/subject/{subject_name}/{subject_id}', [SubjectController::class, 'subjectPage']);

    Route::post('/addSubject', [SubjectController::class, 'addSubject'])->name('addSubject');
    Route::put('/editSubject', [SubjectController::class, 'editSubject']);
    Route::delete('deleteSubject', [SubjectController::class, 'deleteSubject']);
    

    // QUESTIONS
    Route::post('/addQuestion', [QuestionController::class, 'addQuestion']);
    Route::put('/editQuestion', [QuestionController::class, 'editQuestion']);
    Route::delete('/deleteQuestion', [QuestionController::class, 'deleteQuestion']);
    Route::post('/extractQuestions', [QuestionImportController::class, 'extractQuestions']);
    Route::post('/importQuestions', [QuestionImportController::class, 'importQuestions']); 

    Route::get('/questions/{to_view}/{subject_name}/{subject_id}/{module_name}/{module_id}',[QuestionController::class, 'questionsBank']);


    // MODULES
    Route::post('/addModule',[ModuleController::class, 'addModule']);
    Route::put('/editModule', [ModuleController::class, 'editModule']);
    Route::delete('deleteModule', [ModuleController::class, 'deleteModule']);

    // TOPICS
    Route::post('/addTopic', [TopicController::class, 'addTopic']);
    Route::put('/editTopic', [TopicController::class, 'editTopic']);
    Route::delete('/deleteTopic', [TopicController::class, 'deleteTopic']);

    // AUTH
    Route::post('/logout', [LogoutController::class, 'logout']);

    Route::put('/admin-change-password', [PasswordController::class, 'changePassword']);
});