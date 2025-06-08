<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes da Sessão de Estudo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Timer Pomodoro -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center">Timer Pomodoro</h3>
                    <x-pomodoro-timer :duration="25" />
                </div>
            </div>

            <!-- Detalhes da Sessão -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-5">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold">{{ $studySession->subject->name }}</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $studySession->formatted_start_time }} - 
                                    {{ $studySession->duration }} minutos
                                </p>
                            </div>
                            <div class="flex space-x-3">
                                <a href="{{ route('study-sessions.edit', $studySession) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    {{ __('Editar') }}
                                </a>
                                <form method="POST" action="{{ route('study-sessions.destroy', $studySession) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                            onclick="return confirm('Tem certeza que deseja excluir esta sessão de estudo?')">
                                        {{ __('Excluir') }}
                                    </button>
                                </form>
                            </div>
                        </div>

                        <dl class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                <dd class="mt-1">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $studySession->status_color }}-100 dark:bg-{{ $studySession->status_color }}-900 text-{{ $studySession->status_color }}-800 dark:text-{{ $studySession->status_color }}-200">
                                        {{ $studySession->status_label }}
                                    </span>
                                </dd>
                            </div>

                            @if($studySession->description)
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Descrição</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $studySession->description }}
                                    </dd>
                                </div>
                            @endif
                        </dl>
                    </div>

                    <div class="mt-6">
                        <div class="flex justify-end">
                            <x-secondary-button tag="a" href="{{ route('study-sessions.index') }}">
                                {{ __('Voltar') }}
                            </x-secondary-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 