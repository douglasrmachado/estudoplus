<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalhes da Autoavaliação') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('self-assessments.edit', $selfAssessment) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Editar
                </a>
                <form action="{{ route('self-assessments.destroy', $selfAssessment) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Tem certeza que deseja excluir esta autoavaliação?')">
                        Excluir
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Informações Básicas</h3>
                            <div class="space-y-4">
                                <div>
                                    <span class="font-medium">Matéria:</span>
                                    <span class="ml-2">{{ $selfAssessment->subject->name }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Data da Avaliação:</span>
                                    <span class="ml-2">{{ $selfAssessment->assessment_date->format('d/m/Y') }}</span>
                                </div>
                            </div>

                            <h3 class="text-lg font-semibold mt-6 mb-2">Níveis de Avaliação</h3>
                            <div class="space-y-4">
                                <div>
                                    <span class="font-medium">Nível de Compreensão:</span>
                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $selfAssessment->understanding_level_color }}-100 dark:bg-{{ $selfAssessment->understanding_level_color }}-900 text-{{ $selfAssessment->understanding_level_color }}-800 dark:text-{{ $selfAssessment->understanding_level_color }}-200">
                                        {{ $selfAssessment->understanding_level_label }}
                                    </span>
                                </div>
                                <div>
                                    <span class="font-medium">Efetividade dos Estudos:</span>
                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $selfAssessment->study_effectiveness_color }}-100 dark:bg-{{ $selfAssessment->study_effectiveness_color }}-900 text-{{ $selfAssessment->study_effectiveness_color }}-800 dark:text-{{ $selfAssessment->study_effectiveness_color }}-200">
                                        {{ $selfAssessment->study_effectiveness_label }}
                                    </span>
                                </div>
                                <div>
                                    <span class="font-medium">Nível de Confiança:</span>
                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $selfAssessment->confidence_level_color }}-100 dark:bg-{{ $selfAssessment->confidence_level_color }}-900 text-{{ $selfAssessment->confidence_level_color }}-800 dark:text-{{ $selfAssessment->confidence_level_color }}-200">
                                        {{ $selfAssessment->confidence_level_label }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-2">Análise Detalhada</h3>
                            <div class="space-y-6">
                                <div>
                                    <h4 class="font-medium mb-2">Pontos Fortes</h4>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        {{ $selfAssessment->strengths ?: 'Nenhum ponto forte registrado.' }}
                                    </p>
                                </div>
                                <div>
                                    <h4 class="font-medium mb-2">Áreas para Melhorar</h4>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        {{ $selfAssessment->areas_to_improve ?: 'Nenhuma área para melhorar registrada.' }}
                                    </p>
                                </div>
                                <div>
                                    <h4 class="font-medium mb-2">Plano de Ação</h4>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        {{ $selfAssessment->action_plan ?: 'Nenhum plano de ação registrado.' }}
                                    </p>
                                </div>
                                <div>
                                    <h4 class="font-medium mb-2">Observações Adicionais</h4>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        {{ $selfAssessment->notes ?: 'Nenhuma observação registrada.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <x-secondary-button type="button" onclick="window.history.back()">
                            {{ __('Voltar') }}
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 