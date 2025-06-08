<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        Log::info('User ID: ' . $user->id);
        
        $subjects = $user->subjects()->latest()->get();
        Log::info('Subjects count: ' . $subjects->count());
        Log::info('Subjects data: ' . json_encode($subjects));
        
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
        Log::info('Request data: ' . json_encode($request->all()));

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'professor' => 'nullable|string|max:255',
            'workload' => 'nullable|integer|min:0|max:1000',
            'semester' => [
                'nullable',
                'string',
                'max:6',
                'regex:/^(\d{4}[1-2]|\d{4}\.[1-2])$/'
            ],
            'status' => 'required|in:active,completed,cancelled',
            'color' => 'required|string|size:7|regex:/^#[a-zA-Z0-9]{6}$/',
            'description' => 'nullable|string|max:1000',
        ], [
            'semester.max' => 'O campo semestre não pode ter mais que 6 caracteres.',
            'semester.regex' => 'O formato do semestre está inválido. Use 4 dígitos para o ano e 1 dígito (1 ou 2) para o período. Exemplo: 20241 ou 2024.1',
            'workload.max' => 'A carga horária não pode ser maior que 1000 horas.',
            'workload.min' => 'A carga horária não pode ser negativa.'
        ]);

        Log::info('Validated data: ' . json_encode($validated));

        try {
            $subject = new Subject($validated);
            $subject->user_id = auth()->id();
            Log::info('User ID being set: ' . auth()->id());
            $subject->save();
            Log::info('Subject saved with ID: ' . $subject->id);

            return redirect()->route('subjects.index')
                ->with('success', 'Matéria criada com sucesso!');
        } catch (\Exception $e) {
            Log::error('Error saving subject: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $this->authorize('view', $subject);
        
        $tasks = $subject->tasks()
            ->orderBy('due_date')
            ->get();
            
        $selfAssessments = $subject->selfAssessments()
            ->orderBy('assessment_date', 'desc')
            ->get();
            
        $studySessions = $subject->studySessions()
            ->orderBy('start_time', 'desc')
            ->get();

        return view('subjects.show', compact('subject', 'tasks', 'selfAssessments', 'studySessions'));
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
            'professor' => 'nullable|string|max:255',
            'workload' => 'nullable|integer|min:0|max:1000',
            'semester' => [
                'nullable',
                'string',
                'max:6',
                'regex:/^(\d{4}[1-2]|\d{4}\.[1-2])$/'
            ],
            'status' => ['required', 'in:active,completed,cancelled'],
            'color' => 'required|string|size:7|regex:/^#[a-zA-Z0-9]{6}$/',
            'description' => 'nullable|string|max:1000',
        ], [
            'semester.max' => 'O campo semestre não pode ter mais que 6 caracteres.',
            'semester.regex' => 'O formato do semestre está inválido. Use 4 dígitos para o ano e 1 dígito (1 ou 2) para o período. Exemplo: 20241 ou 2024.1',
            'workload.max' => 'A carga horária não pode ser maior que 1000 horas.',
            'workload.min' => 'A carga horária não pode ser negativa.'
        ]);

        // Converte 'cancelled' para 'inactive' se necessário
        if ($validated['status'] === 'cancelled') {
            $validated['status'] = 'inactive';
        }

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
