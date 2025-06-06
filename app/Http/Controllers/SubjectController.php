<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = auth()->user()->subjects()->latest()->get();
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'teacher' => 'nullable|string|max:255',
            'color' => 'required|string|size:7|regex:/^#[a-zA-Z0-9]{6}$/',
            'description' => 'nullable|string|max:1000',
        ]);

        auth()->user()->subjects()->create($validated);

        return redirect()->route('subjects.index')
            ->with('success', 'Matéria criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $this->authorize('update', $subject);
        return view('subjects.form', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $this->authorize('update', $subject);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'teacher' => 'nullable|string|max:255',
            'color' => 'required|string|size:7|regex:/^#[a-zA-Z0-9]{6}$/',
            'description' => 'nullable|string|max:1000',
        ]);

        $subject->update($validated);

        return redirect()->route('subjects.index')
            ->with('success', 'Matéria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);
        
        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Matéria excluída com sucesso!');
    }
}
