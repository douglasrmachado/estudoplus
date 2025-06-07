<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudySessionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SelfAssessmentController;
use App\Http\Controllers\DashboardController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas para Matérias
    Route::resource('materias', SubjectController::class)->parameters([
        'materias' => 'subject'
    ])->names([
        'index' => 'subjects.index',
        'create' => 'subjects.create',
        'store' => 'subjects.store',
        'show' => 'subjects.show',
        'edit' => 'subjects.edit',
        'update' => 'subjects.update',
        'destroy' => 'subjects.destroy',
    ]);

    // Rotas para Tarefas dentro de Matérias
    Route::get('/materias/{subject}/tarefas/criar', [TaskController::class, 'create'])->name('subjects.tasks.create');
    Route::get('/materias/{subject}/autoavaliacoes/criar', [SelfAssessmentController::class, 'create'])->name('subjects.self-assessments.create');
    Route::get('/materias/{subject}/sessoes-estudo/criar', [StudySessionController::class, 'create'])->name('subjects.study-sessions.create');
    
    // Rotas para Sessões de Estudo
    Route::resource('sessoes-estudo', StudySessionController::class)->parameters([
        'sessoes-estudo' => 'study_session'
    ])->names([
        'index' => 'study-sessions.index',
        'create' => 'study-sessions.create',
        'store' => 'study-sessions.store',
        'show' => 'study-sessions.show',
        'edit' => 'study-sessions.edit',
        'update' => 'study-sessions.update',
        'destroy' => 'study-sessions.destroy',
    ]);

    // Rotas para Tarefas
    Route::resource('tarefas', TaskController::class)->parameters([
        'tarefas' => 'task'
    ])->names([
        'index' => 'tasks.index',
        'create' => 'tasks.create',
        'store' => 'tasks.store',
        'show' => 'tasks.show',
        'edit' => 'tasks.edit',
        'update' => 'tasks.update',
        'destroy' => 'tasks.destroy',
    ]);

    // Rotas para Autoavaliações
    Route::resource('autoavaliacoes', SelfAssessmentController::class)->parameters([
        'autoavaliacoes' => 'self_assessment'
    ])->names([
        'index' => 'self-assessments.index',
        'create' => 'self-assessments.create',
        'store' => 'self-assessments.store',
        'show' => 'self-assessments.show',
        'edit' => 'self-assessments.edit',
        'update' => 'self-assessments.update',
        'destroy' => 'self-assessments.destroy',
    ]);
});

require __DIR__.'/auth.php';
