<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Autoavaliação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('self-assessments.update', $selfAssessment) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="subject_id" :value="__('Matéria')" />
                            <select id="subject_id" name="subject_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Selecione uma matéria</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id', $selfAssessment->subject_id) == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('subject_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="assessment_date" :value="__('Data da Avaliação')" />
                            <x-text-input id="assessment_date" name="assessment_date" type="date" class="mt-1 block w-full" :value="old('assessment_date', $selfAssessment->assessment_date->format('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('assessment_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="understanding_level" :value="__('Nível de Compreensão')" />
                            <select id="understanding_level" name="understanding_level" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @foreach($levels as $value => $label)
                                    <option value="{{ $value }}" {{ old('understanding_level', $selfAssessment->understanding_level) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('understanding_level')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="study_effectiveness" :value="__('Efetividade dos Estudos')" />
                            <select id="study_effectiveness" name="study_effectiveness" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @foreach($levels as $value => $label)
                                    <option value="{{ $value }}" {{ old('study_effectiveness', $selfAssessment->study_effectiveness) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('study_effectiveness')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="confidence_level" :value="__('Nível de Confiança')" />
                            <select id="confidence_level" name="confidence_level" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @foreach($levels as $value => $label)
                                    <option value="{{ $value }}" {{ old('confidence_level', $selfAssessment->confidence_level) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('confidence_level')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="strengths" :value="__('Pontos Fortes')" />
                            <textarea id="strengths" name="strengths" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('strengths', $selfAssessment->strengths) }}</textarea>
                            <x-input-error :messages="$errors->get('strengths')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="areas_to_improve" :value="__('Áreas para Melhorar')" />
                            <textarea id="areas_to_improve" name="areas_to_improve" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('areas_to_improve', $selfAssessment->areas_to_improve) }}</textarea>
                            <x-input-error :messages="$errors->get('areas_to_improve')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="action_plan" :value="__('Plano de Ação')" />
                            <textarea id="action_plan" name="action_plan" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('action_plan', $selfAssessment->action_plan) }}</textarea>
                            <x-input-error :messages="$errors->get('action_plan')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="notes" :value="__('Observações Adicionais')" />
                            <textarea id="notes" name="notes" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('notes', $selfAssessment->notes) }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                                {{ __('Cancelar') }}
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('Atualizar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 