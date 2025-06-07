<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($subject) ? __('Editar Matéria') : __('Nova Matéria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ isset($subject) ? route('subjects.update', $subject) : route('subjects.store') }}" class="space-y-6">
                        @csrf
                        @if(isset($subject))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('Nome da Matéria')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name', isset($subject) ? $subject->name : '')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="professor" :value="__('Professor(a)')" />
                                <x-text-input id="professor" name="professor" type="text" class="mt-1 block w-full"
                                    :value="old('professor', isset($subject) ? $subject->professor : '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('professor')" />
                            </div>

                            <div>
                                <x-input-label for="workload" :value="__('Carga Horária (horas)')" />
                                <x-text-input id="workload" name="workload" type="number" class="mt-1 block w-full"
                                    :value="old('workload', isset($subject) ? $subject->workload : '')" min="0" />
                                <x-input-error class="mt-2" :messages="$errors->get('workload')" />
                            </div>

                            <div>
                                <x-input-label for="semester" :value="__('Semestre')" />
                                <x-text-input id="semester" name="semester" type="text" class="mt-1 block w-full"
                                    :value="old('semester', isset($subject) ? $subject->semester : '')" placeholder="Ex: 2024.1" />
                                <x-input-error class="mt-2" :messages="$errors->get('semester')" />
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status" 
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="active" {{ old('status', isset($subject) ? $subject->status : '') == 'active' ? 'selected' : '' }}>
                                        Ativa
                                    </option>
                                    <option value="completed" {{ old('status', isset($subject) ? $subject->status : '') == 'completed' ? 'selected' : '' }}>
                                        Concluída
                                    </option>
                                    <option value="cancelled" {{ old('status', isset($subject) ? $subject->status : '') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelada
                                    </option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>

                            <div>
                                <x-input-label for="color" :value="__('Cor')" />
                                <x-text-input id="color" name="color" type="color" class="mt-1 block w-20 h-10"
                                    :value="old('color', isset($subject) ? $subject->color : '#3490dc')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('color')" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="description" :value="__('Descrição')" />
                                <textarea id="description" name="description" rows="3" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', isset($subject) ? $subject->description : '') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 pt-4">
                            <x-secondary-button tag="a" href="{{ route('subjects.index') }}">
                                {{ __('Cancelar') }}
                            </x-secondary-button>
                            
                            <x-primary-button>
                                {{ isset($subject) ? __('Atualizar') : __('Criar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 