<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes da Tarefa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden">
                        <div class="px-4 py-5 sm:p-6">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Título</dt>
                                    <dd class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $task->title }}</dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Matéria</dt>
                                    <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $task->subject->name }}</dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Data de Entrega</dt>
                                    <dd class="mt-1 text-gray-900 dark:text-gray-100">
                                        {{ $task->due_date->format('d/m/Y') }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Prioridade</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $task->priority_color }}-100 dark:bg-{{ $task->priority_color }}-900 text-{{ $task->priority_color }}-800 dark:text-{{ $task->priority_color }}-200">
                                            {{ $task->priority_label }}
                                        </span>
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $task->status_color }}-100 dark:bg-{{ $task->status_color }}-900 text-{{ $task->status_color }}-800 dark:text-{{ $task->status_color }}-200">
                                            {{ $task->status_label }}
                                        </span>
                                    </dd>
                                </div>

                                @if($task->description)
                                    <div class="sm:col-span-2">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Descrição</dt>
                                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $task->description }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        <div class="px-4 py-4 sm:px-6 bg-gray-50 dark:bg-gray-700 flex justify-between items-center">
                            <x-secondary-button tag="a" href="{{ route('tasks.index') }}">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                {{ __('Voltar') }}
                            </x-secondary-button>

                            <div class="flex space-x-3">
                                <x-primary-button tag="a" href="{{ route('tasks.edit', $task) }}">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    {{ __('Editar') }}
                                </x-primary-button>

                                <form action="{{ route('tasks.destroy', $task) }}" 
                                      method="POST" 
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="submit" 
                                                    onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        {{ __('Excluir') }}
                                    </x-danger-button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 