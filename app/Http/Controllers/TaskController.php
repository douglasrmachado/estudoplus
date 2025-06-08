<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    public function index(): View
    {
        $tasks = Task::whereHas('subject', function($q) {
            $q->where('user_id', Auth::id());
        })->with('subject')
            ->orderBy('due_date')
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function create(Request $request): View
    {
        $subjects = Subject::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();
            
        $selectedSubject = null;
        
        if ($request->has('subject_id')) {
            $selectedSubject = Subject::where('user_id', Auth::id())
                ->findOrFail($request->subject_id);
        }
        
        return view('tasks.create', [
            'subjects' => $subjects,
            'selectedSubject' => $selectedSubject,
            'priorities' => Task::priorities(),
            'statuses' => Task::statuses(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'subject_id' => ['required', 'exists:subjects,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['required', 'date'],
            'priority' => ['required', 'in:low,medium,high'],
            'status' => ['required', 'in:pending,in_progress,completed,cancelled'],
        ]);

        // Verifica se a matéria pertence ao usuário
        $subject = Subject::where('user_id', Auth::id())
            ->findOrFail($validated['subject_id']);

        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarefa criada com sucesso!');
    }

    public function show(Task $task): View
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        $this->authorize('update', $task);
        
        $subjects = Subject::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();
            
        return view('tasks.edit', [
            'task' => $task,
            'subjects' => $subjects,
            'priorities' => Task::priorities(),
            'statuses' => Task::statuses(),
        ]);
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'subject_id' => ['required', 'exists:subjects,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['required', 'date'],
            'priority' => ['required', 'in:low,medium,high'],
            'status' => ['required', 'in:pending,in_progress,completed,cancelled'],
        ]);

        // Verifica se a matéria pertence ao usuário
        $subject = Subject::where('user_id', Auth::id())
            ->findOrFail($validated['subject_id']);

        $task->update($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);
        
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarefa excluída com sucesso!');
    }
} 