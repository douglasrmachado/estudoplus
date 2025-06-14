<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Visão Geral') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Estatísticas Rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Tarefas Concluídas</p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $completedTasks }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Horas Estudadas</p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $totalStudyHours }}h</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Matérias em Andamento</p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $activeSubjects }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Tarefas Pendentes</p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $pendingTasks }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Próximas Atividades e Sessões de Estudo -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Próximas Tarefas -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Próximas Tarefas</h3>
                        @if($upcomingTasks->isEmpty())
                            <p class="text-gray-600 dark:text-gray-400">Nenhuma tarefa pendente.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($upcomingTasks as $task)
                                    <div class="flex items-center justify-between border-b dark:border-gray-700 pb-3">
                                        <div>
                                            <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $task->title }}</h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $task->subject->name }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-medium {{ $task->due_date->isPast() ? 'text-red-600 dark:text-red-400' : 'text-gray-600 dark:text-gray-400' }}">
                                                {{ $task->due_date->format('d/m/Y') }}
                                            </p>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ 
                                                $task->priority === 'high' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 
                                                ($task->priority === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 
                                                'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200') 
                                            }}">
                                                {{ $task->priority_label }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Próximas Sessões de Estudo -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Próximas Sessões de Estudo</h3>
                        @if($upcomingStudySessions->isEmpty())
                            <p class="text-gray-600 dark:text-gray-400">Nenhuma sessão de estudo agendada.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($upcomingStudySessions as $session)
                                    <div class="flex items-center justify-between border-b dark:border-gray-700 pb-3">
                                        <div>
                                            <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $session->subject->name }}</h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                Duração: {{ $session->duration }} minutos
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                                                {{ $session->formatted_start_time }}
                                            </p>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                {{ $session->status_label }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Progresso das Matérias -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Progresso das Matérias</h3>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('dashboard', ['status' => 'all']) }}" 
                               class="inline-flex items-center px-3 py-1 text-sm rounded-full transition-colors {{ $statusFilter === 'all' ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                Todas
                            </a>
                            <a href="{{ route('dashboard', ['status' => 'active']) }}" 
                               class="inline-flex items-center px-3 py-1 text-sm rounded-full transition-colors {{ $statusFilter === 'active' ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-800' }}">
                                Em Andamento
                            </a>
                            <a href="{{ route('dashboard', ['status' => 'completed']) }}" 
                               class="inline-flex items-center px-3 py-1 text-sm rounded-full transition-colors {{ $statusFilter === 'completed' ? 'bg-green-500 text-white' : 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-800' }}">
                                Concluída
                            </a>
                            <a href="{{ route('dashboard', ['status' => 'cancelled']) }}" 
                               class="inline-flex items-center px-3 py-1 text-sm rounded-full transition-colors {{ $statusFilter === 'cancelled' ? 'bg-red-500 text-white' : 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-800' }}">
                                Inativa
                            </a>
                        </div>
                    </div>
                    @if($subjects->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">
                            @if($statusFilter === 'all')
                                Nenhuma matéria cadastrada.
                            @else
                                Nenhuma matéria {{ $statusFilter === 'active' ? 'em andamento' : ($statusFilter === 'completed' ? 'concluída' : 'inativa') }}.
                            @endif
                        </p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($subjects as $subject)
                                <div class="border dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                    <div class="flex justify-between items-center mb-2">
                                        <div>
                                            <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $subject->name }}</h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $subject->professor ?: 'Professor não informado' }} • {{ $subject->semester }}
                                            </p>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ 
                                            $subject->status === 'completed' ? 'bg-green-500 text-white' : 
                                            ($subject->status === 'active' ? 'bg-blue-500 text-white' : 
                                            'bg-red-500 text-white') 
                                        }}">
                                            {{ $subject->status === 'completed' ? 'Concluída' : ($subject->status === 'active' ? 'Em Andamento' : 'Inativa') }}
                                        </span>
                                    </div>
                                    <div class="space-y-3">
                                        <div>
                                            <div class="flex justify-between text-sm mb-1">
                                                <span class="text-gray-600 dark:text-gray-400">Tarefas</span>
                                                <span class="text-gray-900 dark:text-gray-100">
                                                    <strong>{{ $subject->completed_tasks_count }}</strong>/{{ $subject->total_tasks_count }}
                                                </span>
                                            </div>
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                                <div class="bg-green-500 h-2 rounded-full transition-all duration-300" style="width: {{ $subject->total_tasks_count > 0 ? ($subject->completed_tasks_count / $subject->total_tasks_count * 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex justify-between text-sm mb-1">
                                                <span class="text-gray-600 dark:text-gray-400">Carga Horária</span>
                                                <span class="text-gray-900 dark:text-gray-100">
                                                    <strong>{{ number_format($subject->total_study_hours, 1) }}</strong>/{{ $subject->workload }}h
                                                </span>
                                            </div>
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                                <div class="bg-blue-500 h-2 rounded-full transition-all duration-300" style="width: {{ $subject->workload > 0 ? min(($subject->total_study_hours / $subject->workload * 100), 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Últimas Autoavaliações -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Últimas Autoavaliações</h3>
                    @if($recentSelfAssessments->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">Nenhuma autoavaliação registrada.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($recentSelfAssessments as $assessment)
                                <div class="border dark:border-gray-700 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $assessment->subject->name }}</h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $assessment->assessment_date->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $assessment->getLevelColorAttribute('understanding_level') }}-100 text-{{ $assessment->getLevelColorAttribute('understanding_level') }}-800 dark:bg-{{ $assessment->getLevelColorAttribute('understanding_level') }}-900 dark:text-white">
                                                Compreensão: {{ $assessment->understanding_level_label }}
                                            </span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $assessment->getLevelColorAttribute('confidence_level') }}-100 text-{{ $assessment->getLevelColorAttribute('confidence_level') }}-800 dark:bg-{{ $assessment->getLevelColorAttribute('confidence_level') }}-900 dark:text-white">
                                                Confiança: {{ $assessment->confidence_level_label }}
                                            </span>
                                        </div>
                                    </div>
                                    @if($assessment->action_plan)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                            <span class="font-medium">Plano de Ação:</span> {{ Str::limit($assessment->action_plan, 150) }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
