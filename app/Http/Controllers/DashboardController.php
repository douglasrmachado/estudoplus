<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Task;
use App\Models\StudySession;
use App\Models\SelfAssessment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Estatísticas Rápidas
        $completedTasks = Task::whereHas('subject', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('status', 'completed')->count();

        $totalStudyHours = StudySession::whereHas('subject', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('status', 'completed')
          ->sum('duration') / 60; // Convertendo minutos para horas

        $activeSubjects = Subject::where('user_id', $user->id)
            ->where('status', 'active')
            ->count();

        $pendingTasks = Task::whereHas('subject', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('status', 'pending')->count();

        // Próximas Tarefas
        $upcomingTasks = Task::whereHas('subject', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('status', 'pending')
          ->orderBy('due_date')
          ->take(5)
          ->get();

        // Próximas Sessões de Estudo
        $upcomingStudySessions = StudySession::whereHas('subject', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('status', 'planned')
          ->orderBy('start_time')
          ->take(5)
          ->get();

        // Progresso das Matérias
        $subjects = Subject::where('user_id', $user->id)
            ->where('status', 'active')
            ->withCount(['tasks as completed_tasks_count' => function($q) {
                $q->where('status', 'completed');
            }])
            ->withCount(['tasks as total_tasks_count'])
            ->get()
            ->map(function($subject) {
                $subject->total_study_hours = $subject->studySessions()
                    ->where('status', 'completed')
                    ->sum('duration') / 60;
                return $subject;
            });

        // Últimas Autoavaliações
        $recentSelfAssessments = SelfAssessment::whereHas('subject', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with('subject')
          ->orderBy('assessment_date', 'desc')
          ->take(5)
          ->get();

        return view('dashboard', compact(
            'completedTasks',
            'totalStudyHours',
            'activeSubjects',
            'pendingTasks',
            'upcomingTasks',
            'upcomingStudySessions',
            'subjects',
            'recentSelfAssessments'
        ));
    }

    private function getCurrentSemester()
    {
        $now = now();
        $year = $now->year;
        $month = $now->month;
        $semester = $month <= 6 ? '1' : '2';
        
        return $year . '.' . $semester;
    }
} 