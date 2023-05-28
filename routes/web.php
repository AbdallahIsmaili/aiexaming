<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\OptionController;
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

Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('/subject', SubjectController::class)->names([
        'index' => 'subject.index'
    ]);

    Route::resource('/exam', ExamController::class)->names([
        'index' => 'exam.index'
    ]);

    Route::resource('/question', QuestionController::class)->names([
        'index' => 'question.index'
    ]);

    Route::resource('/option', OptionController::class)->names([
        'index' => 'option.index'
    ]);

    Route::get('/exam/{id}/question/create', [ExamController::class, 'createQuestion'])->name('exam.question.create');


});

require __DIR__.'/auth.php';
