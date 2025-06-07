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
    public function create()
    {
        $subjects = Subject::where('user_id', Auth::id())->get();
        return view('study-sessions.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'start_time' => 'required|date',
            'duration' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status' => 'required|in:planned,in_progress,completed,cancelled',
        ]);

        StudySession::create($validated);

        return redirect()->route('study-sessions.index')
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

        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'start_time' => 'required|date',
            'duration' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status' => 'required|in:planned,in_progress,completed,cancelled',
        ]);

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