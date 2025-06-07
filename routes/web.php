<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudySessionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SelfAssessmentController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('subjects', SubjectController::class);
    Route::get('/subjects/{subject}/tasks/create', [TaskController::class, 'create'])->name('subjects.tasks.create');
    Route::get('/subjects/{subject}/self-assessments/create', [SelfAssessmentController::class, 'create'])->name('subjects.self-assessments.create');
    Route::get('/subjects/{subject}/study-sessions/create', [StudySessionController::class, 'create'])->name('subjects.study-sessions.create');
    
    Route::resource('study-sessions', StudySessionController::class);
    Route::resource('tasks', TaskController::class)
        ->middleware(['auth', 'verified']);
    Route::resource('self-assessments', SelfAssessmentController::class)
        ->middleware(['auth', 'verified']);
});

require __DIR__.'/auth.php';
