<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nova Sessão de Estudo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('study-sessions.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="subject_id" :value="__('Matéria')" />
                            <select id="subject_id" 
                                    name="subject_id" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>
                                <option value="">Selecione uma matéria</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('subject_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="start_time" :value="__('Data e Hora de Início')" />
                            <x-text-input id="start_time" 
                                         name="start_time" 
                                         type="datetime-local"
                                         class="mt-1 block w-full"
                                         :value="old('start_time')"
                                         required />
                            <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="duration" :value="__('Duração (em minutos)')" />
                            <x-text-input id="duration" 
                                         name="duration" 
                                         type="number"
                                         class="mt-1 block w-full"
                                         :value="old('duration')"
                                         min="1"
                                         required />
                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Descrição')" />
                            <textarea id="description" 
                                     name="description" 
                                     rows="3" 
                                     class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" 
                                    name="status" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>
                                <option value="planned" {{ old('status') == 'planned' ? 'selected' : '' }}>
                                    Planejada
                                </option>
                                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>
                                    Em Andamento
                                </option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                    Concluída
                                </option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                                    Cancelada
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between pt-4">
                            <x-secondary-button tag="a" href="{{ route('study-sessions.index') }}">
                                {{ __('Voltar') }}
                            </x-secondary-button>

                            <x-primary-button>
                                {{ __('Criar Sessão') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 