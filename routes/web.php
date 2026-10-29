<?php

use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\AssessmentController;
use App\Http\Controllers\Client\CodePretestController;
use App\Http\Controllers\Client\LearnController;
use App\Http\Controllers\Client\Pretest;
use App\Http\Controllers\CodeRunnerController;
use App\Http\Controllers\Logout;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\Pages\QuestionsPage;
use App\Http\Controllers\Question;
use App\Http\Controllers\QuestionImport;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyOTP;
use App\Models\AnsweredAssessmentQuestions;
use App\Models\AnsweredModuleQuestions;
use App\Models\Feedback;
use App\Models\Leaderboard;
use App\Models\ModuleQuiz;
use App\Models\Modules;
use App\Models\RecentActivity;
use App\Models\Subjects;
use App\Models\SubjectStarted;
use App\Models\User;
use App\Models\UserScoreboard;
use Illuminate\Support\Facades\Route;


Route::post('/run-code', [CodeRunnerController::class, 'run'])
    ->middleware(['throttle:20,1']);


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
    Route::post('/verify_otp', [VerifyOTP::class, 'verify'])->middleware('throttle:2,1');

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

        $subjects_started = SubjectStarted::where('user_id', auth()->id())->get();

        $user_leaderboard = Leaderboard::where('user_id', auth()->id())->exists();
        $user_scoreboard = UserScoreboard::where('user_id', auth()->id())->exists();

        if(!$user_leaderboard){
            Leaderboard::create([
                'user_id' => auth()->id(),
            ]);
        }

        if(!$user_scoreboard){
            UserScoreboard::create([
                'user_id' => auth()->id(),
                'total_score' => 0
            ]);
        }

        
        $leaderboard = Leaderboard::where('points', '>', 0)
            ->orderBy('points', 'DESC')
            ->take(20)
            ->get();

        $users = User::whereIn('id', $leaderboard->pluck('user_id'))
            ->select('id', 'name', 'profile_color', 'profile_picture')
            ->get()
            ->keyBy('id');

        $answered_assessment_questions = AnsweredAssessmentQuestions::where('user_id', auth()->id())->get();
        $answered_module_questions = AnsweredModuleQuestions::where('user_id', auth()->id())->get();

        // $total_answered_module = $answered_module_questions->count();
        // $total_answered_assessment = $answered_assessment_questions->count();

        $total_assessment_score = $answered_assessment_questions->where('is_correct', true)->count();

        $score_count = 0;
        foreach($answered_module_questions as $amq){
            if(strtolower($amq->user_answer) === strtolower($amq->correct_answer)){
                $score_count++;
            }
        }

        $total_answered = $answered_assessment_questions->count() + $answered_module_questions->count();
        $total_score = $total_assessment_score + $score_count;

        $accuracy = $total_answered > 0
            ? round(($total_score / $total_answered) * 100)
            : 0;

        
        return view('Client.Pages.Home', compact(
            'subjects',
            'modules',
            'module_pretests',
            'leaderboard',
            'users',
            'subjects_started',
            'total_score',
            'accuracy'
        ));
    })->name('home');


    // ===========================================================
    // ===========================================================

    Route::get('/learn/{subject_name}/{subject_id}', [LearnController::class, 'learn']);
    Route::get('/learning/{subject_name}/{subject_id}/{module_name}/{module_id}', [LearnController::class, 'learnModule']);
    Route::put('/module-progress', [LearnController::class, 'scrollModuleProgress']);
    Route::post('/submit-module-activity', [LearnController::class, 'submitModuleActivity']);
    Route::post('/retake-activity', [LearnController::class, 'retakeActivity']);

    Route::post('/sendFeedback', [FeedbackController::class, 'sendFeedback'])->middleware('throttle:3,1');

    

    Route::get('/result/{type_of_assessment}/{type}/{subject_name}/{subject_id}/{module_name}/{module_id}', [Pretest::class, 'resultPretest']);

    Route::post('/submitAnswer', [Pretest::class, 'submitAnswer']);
    Route::post('/submitCode', [CodePretestController::class, 'submitCodeAnswer']);

    Route::get('/pretest/{subject_name}/{subject_id}', [Pretest::class, 'pretestModules']);
    Route::get('/assessment/{type_of_assessment}/{to_take}/{subject_name}/{subject_id}/{module_name}/{module_id}', [AssessmentController::class, 'taking_assessment'])->name('pretest.taking');

    Route::put('/change-password', [PasswordController::class, 'changePassword']);
    Route::post('/logout_student', [Logout::class, 'logout']);

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
        return view('Admin.Pages.Dashboard', compact(
            'total_users',
            'total_admins',
            'total_subjects',
            'recent_activities',
        ));
    })->name('dashboard_page');

    // ===========================================================
    // ===========================================================
    Route::get('/users', function(){
        $users = User::select('id','id_number', 'name', 'email','role', 'status','profile_color', 'profile_picture')->get();
        return view('Admin.Pages.Users', compact(
            'users'
        ));
    })->name('users_page');

    // ===========================================================
    // ===========================================================
    Route::get('/subjects', function(){

        $subjects = Subjects::select('id', 'subject_name', 'subject_code', 'slug', 'order')
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

        $feedbacks = Feedback::select('id', 'student_name', 'replied_by', 'status', 'created_at')->get();
        return view('Admin.Pages.Feedbacks', compact(
            'feedbacks'
        ));
    })->name('feedbacks_page');



    // ===========================================================
    // ===========================================================

    // USERS
    Route::put('/promoteUser', [UserController::class, 'promoteUser']);
    Route::put('/demoteUser', [UserController::class, 'demoteUser']);
    Route::delete('/deleteUser', [UserController::class, 'deleteUser']);


    // SUBJECTS
    Route::get('/subject/{subject_name}/{subject_id}', [SubjectController::class, 'subjectPage']);
    Route::post('/addSubject', [SubjectController::class, 'addSubject'])->name('addSubject');
    

    // QUESTIONS
    Route::post('/addQuestion', [Question::class, 'addQuestion']);
    Route::put('/editQuestion', [Question::class, 'editQuestion']);
    Route::delete('/deleteQuestion', [Question::class, 'deleteQuestion']);
    Route::post('/extractQuestions', [QuestionImport::class, 'extractQuestions']);
    Route::post('/importQuestions', [QuestionImport::class, 'importQuestions']); 

    Route::get('/questions/{to_view}/{subject_name}/{subject_id}/{module_name}/{module_id}',[QuestionsPage::class, 'questions']);


    // MODULES
    Route::post('/addModule',[ModuleController::class, 'addModule']);
    Route::put('/editModule', [ModuleController::class, 'editModule']);
    Route::delete('deleteModule', [ModuleController::class, 'deleteModule']);

    // TOPICS
    Route::post('/addTopic', [TopicController::class, 'addTopic']);

    Route::post('/logout', [Logout::class, 'logout']);
});
