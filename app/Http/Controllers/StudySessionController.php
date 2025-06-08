<?php

namespace App\Http\Controllers;

use App\Models\StudySession;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudySessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = StudySession::with('subject')
            ->whereHas('subject', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('start_time', 'desc')
            ->paginate(10);

        return view('study-sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $subjects = Subject::where('user_id', Auth::id())->get();
        $selectedSubject = null;
        
        if ($request->has('subject_id')) {
            $selectedSubject = Subject::findOrFail($request->subject_id);
        }
        
        return view('study-sessions.create', compact('subjects', 'selectedSubject'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'start_time.required' => 'A data de início é obrigatória.',
            'start_time.date' => 'A data de início deve estar em um formato válido.',
            'start_time.after_or_equal' => 'A data de início deve ser igual ou posterior a hoje.',
            'start_time.date_format' => 'A data deve estar no formato dd/mm/aaaa.',
            'duration.required' => 'A duração é obrigatória.',
            'duration.integer' => 'A duração deve ser um número inteiro.',
            'duration.min' => 'A duração deve ser de pelo menos 1 minuto.',
            'subject_id.required' => 'A matéria é obrigatória.',
            'subject_id.exists' => 'A matéria selecionada é inválida.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status selecionado é inválido.'
        ];

        $validated = $request->validate([
            'start_time' => ['required', 'date', 'after_or_equal:today'],
            'duration' => ['required', 'integer', 'min:1'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:planned,in_progress,completed,cancelled']
        ], $messages);

        // Converte a data para o formato correto
        $validated['start_time'] = date('Y-m-d 00:00:00', strtotime($validated['start_time']));

        $studySession = StudySession::create($validated);

        return redirect()->route('study-sessions.show', $studySession)
            ->with('success', 'Sessão de estudo criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudySession $studySession)
    {
        $this->authorize('view', $studySession);
        return view('study-sessions.show', compact('studySession'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudySession $studySession)
    {
        $this->authorize('update', $studySession);
        $subjects = Subject::where('user_id', Auth::id())->get();
        return view('study-sessions.edit', compact('studySession', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudySession $studySession)
    {
        $this->authorize('update', $studySession);

        $messages = [
            'start_time.required' => 'A data de início é obrigatória.',
            'start_time.date' => 'A data de início deve estar em um formato válido.',
            'start_time.after_or_equal' => 'A data de início deve ser igual ou posterior a hoje.',
            'start_time.date_format' => 'A data deve estar no formato dd/mm/aaaa.',
            'duration.required' => 'A duração é obrigatória.',
            'duration.integer' => 'A duração deve ser um número inteiro.',
            'duration.min' => 'A duração deve ser de pelo menos 1 minuto.',
            'subject_id.required' => 'A matéria é obrigatória.',
            'subject_id.exists' => 'A matéria selecionada é inválida.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status selecionado é inválido.'
        ];

        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'start_time' => ['required', 'date', 'after_or_equal:today'],
            'duration' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status' => 'required|in:planned,in_progress,completed,cancelled',
        ], $messages);

        // Converte a data para o formato correto
        $validated['start_time'] = date('Y-m-d 00:00:00', strtotime($validated['start_time']));

        $studySession->update($validated);

        return redirect()->route('study-sessions.index')
            ->with('success', 'Sessão de estudo atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudySession $studySession)
    {
        $this->authorize('delete', $studySession);
        
        $studySession->delete();

        return redirect()->route('study-sessions.index')
            ->with('success', 'Sessão de estudo excluída com sucesso!');
    }
} 