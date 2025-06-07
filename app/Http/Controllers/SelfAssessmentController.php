<?php

namespace App\Http\Controllers;

use App\Models\SelfAssessment;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SelfAssessmentController extends Controller
{
    public function index(): View
    {
        $assessments = SelfAssessment::with('subject')
            ->orderBy('assessment_date', 'desc')
            ->paginate(10);

        return view('self-assessments.index', compact('assessments'));
    }

    public function create(Request $request): View
    {
        $subjects = Subject::orderBy('name')->get();
        $selectedSubject = null;
        
        if ($request->has('subject_id')) {
            $selectedSubject = Subject::findOrFail($request->subject_id);
        }
        
        $levels = SelfAssessment::levels();

        return view('self-assessments.create', compact('subjects', 'selectedSubject', 'levels'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'assessment_date' => 'required|date',
            'understanding_level' => 'required|integer|min:1|max:5',
            'study_effectiveness' => 'required|integer|min:1|max:5',
            'confidence_level' => 'required|integer|min:1|max:5',
            'strengths' => 'nullable|string|max:1000',
            'areas_to_improve' => 'nullable|string|max:1000',
            'action_plan' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:1000',
        ]);

        SelfAssessment::create($validated);

        return redirect()->route('self-assessments.index')
            ->with('success', 'Autoavaliação registrada com sucesso!');
    }

    public function show(SelfAssessment $selfAssessment): View
    {
        return view('self-assessments.show', compact('selfAssessment'));
    }

    public function edit(SelfAssessment $selfAssessment): View
    {
        $subjects = Subject::orderBy('name')->get();
        $levels = SelfAssessment::levels();

        return view('self-assessments.edit', compact('selfAssessment', 'subjects', 'levels'));
    }

    public function update(Request $request, SelfAssessment $selfAssessment): RedirectResponse
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'assessment_date' => 'required|date',
            'understanding_level' => 'required|integer|min:1|max:5',
            'study_effectiveness' => 'required|integer|min:1|max:5',
            'confidence_level' => 'required|integer|min:1|max:5',
            'strengths' => 'nullable|string|max:1000',
            'areas_to_improve' => 'nullable|string|max:1000',
            'action_plan' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:1000',
        ]);

        $selfAssessment->update($validated);

        return redirect()->route('self-assessments.index')
            ->with('success', 'Autoavaliação atualizada com sucesso!');
    }

    public function destroy(SelfAssessment $selfAssessment): RedirectResponse
    {
        $selfAssessment->delete();

        return redirect()->route('self-assessments.index')
            ->with('success', 'Autoavaliação excluída com sucesso!');
    }
} 