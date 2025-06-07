<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card Matérias -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Matérias</h3>
                            <a href="{{ route('subjects.create') }}" 
                               class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Nova Matéria
                            </a>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Gerencie suas matérias, adicione informações sobre professores, carga horária e acompanhe seu progresso.
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('subjects.index') }}" 
                               class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 font-medium">
                                Ver todas as matérias →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Sessões de Estudo -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Sessões de Estudo</h3>
                            <a href="{{ route('study-sessions.create') }}" 
                               class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Nova Sessão
                            </a>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Planeje e acompanhe suas sessões de estudo, defina objetivos e mantenha um registro do seu progresso.
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('study-sessions.index') }}" 
                               class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 font-medium">
                                Ver todas as sessões →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Estatísticas -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg md:col-span-2">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Visão Geral</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total de Matérias</div>
                                <div class="mt-1 text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                    {{ App\Models\Subject::where('user_id', Auth::id())->count() }}
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Sessões Planejadas</div>
                                <div class="mt-1 text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                    {{ App\Models\StudySession::whereHas('subject', function($q) { 
                                        $q->where('user_id', Auth::id()); 
                                    })->where('status', 'planned')->count() }}
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Sessões Concluídas</div>
                                <div class="mt-1 text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                    {{ App\Models\StudySession::whereHas('subject', function($q) { 
                                        $q->where('user_id', Auth::id()); 
                                    })->where('status', 'completed')->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
