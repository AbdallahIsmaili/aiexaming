<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserResponseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::resource('/', HomeController::class)->middleware(['auth', 'verified'])->names([
    'index' => 'home.index'
]);


Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('/subject', SubjectController::class)->names([
        'index' => 'subject.index'
    ]);

    Route::resource('/exam', ExamController::class)->names([
        'index' => 'exam.index'
    ]);

    Route::resource('/question', QuestionController::class)->except(['show'])->names([
        'index' => 'question.index'
    ]);

    Route::resource('/option', OptionController::class)->names([
        'index' => 'option.index'
    ]);

    Route::get('/exam/{id}/question/create', [ExamController::class, 'createQuestion'])->name('exam.question.create');

    Route::get('/exam/{id}/testing', [ExamController::class, 'testExam'])->name('exam.test');

    // Route::get('/exam/{exam_id}/testing/question/{question_id}', [ExamController::class, 'testQuestion'])->name('exam.question.test');

    Route::get('/question/{id}/option/create', [QuestionController::class, 'createOption'])->name('question.option.create');

});



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/exam/{id}/start', [ExamController::class, 'startExam'])->name('startExam');

    Route::get('/exam/{exam_id}/question/{question_id}', [QuestionController::class, 'show'])->name('question.show');

    Route::resource('/user-response', UserResponseController::class)->names([ 'index' => 'user-response.index']);

    Route::get('/result/{id}/exam', function(){
        return view('exams.result');
    })->name('result');

});

require __DIR__.'/auth.php';
