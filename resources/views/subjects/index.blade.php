<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Minhas Matérias') }}
            </h2>
            <x-primary-button tag="a" href="{{ route('subjects.create') }}" class="ml-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('Nova Matéria') }}
            </x-primary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($subjects->isEmpty())
                        <div class="text-center py-8">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Você ainda não tem matérias cadastradas</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Comece adicionando sua primeira matéria!</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($subjects as $subject)
                                <div class="border dark:border-gray-700 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow h-full"
                                     style="border-left: 4px solid {{ $subject->color }}">
                                    <div class="p-4 flex flex-col h-full justify-between">
                                        <div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                    {{ $subject->name }}
                                                </h3>
                                                @if($subject->semester)
                                                    <span class="inline-block text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $subject->semester }}
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="mt-3 space-y-2">
                                                @if($subject->professor)
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                                        <span class="font-medium">Professor(a):</span> {{ $subject->professor }}
                                                    </p>
                                                @endif

                                                @if($subject->workload)
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                                        <span class="font-medium">Carga Horária:</span> {{ $subject->workload }}h
                                                    </p>
                                                @endif

                                                @if($subject->description)
                                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                                        {{ Str::limit($subject->description, 100) }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mt-4 flex justify-between items-center">
                                            <a href="{{ route('subjects.show', $subject) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Visualizar
                                            </a>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('subjects.edit', $subject) }}" 
                                                   class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300" 
                                                            onclick="return confirm('Tem certeza que deseja excluir esta matéria?')">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 