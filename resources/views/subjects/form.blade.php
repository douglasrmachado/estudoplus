<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($subject) ? __('Editar Matéria') : __('Nova Matéria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ isset($subject) ? route('subjects.update', $subject) : route('subjects.store') }}">
                        @csrf
                        @if(isset($subject))
                            @method('PUT')
                        @endif

                        <div class="grid gap-6 mb-6">
                            <div>
                                <x-input-label for="name" :value="__('Nome da Matéria')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name', isset($subject) ? $subject->name : '')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="teacher" :value="__('Professor(a)')" />
                                <x-text-input id="teacher" name="teacher" type="text" class="mt-1 block w-full"
                                    :value="old('teacher', isset($subject) ? $subject->teacher : '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('teacher')" />
                            </div>

                            <div>
                                <x-input-label for="color" :value="__('Cor')" />
                                <x-text-input id="color" name="color" type="color" class="mt-1 block w-20 h-10"
                                    :value="old('color', isset($subject) ? $subject->color : '#3490dc')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('color')" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Descrição')" />
                                <textarea id="description" name="description"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    rows="3">{{ old('description', isset($subject) ? $subject->description : '') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                            <a href="{{ route('subjects.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                {{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 