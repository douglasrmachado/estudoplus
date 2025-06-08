<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-b from-indigo-50 to-white dark:from-gray-900 dark:to-gray-800">
        <div class="mb-8 text-center">
            <x-application-logo class="block mb-4" />
            <h1 class="text-4xl font-bold text-indigo-600 dark:text-indigo-400">Estudo+</h1>
        </div>

        <div class="w-full sm:max-w-md px-6 py-8 bg-gradient-to-b from-indigo-50/50 to-white/50 dark:from-gray-800/50 dark:to-gray-900/50 backdrop-blur-sm shadow-xl overflow-hidden sm:rounded-xl">
            <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-8">Criar nova conta</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nome')" class="text-gray-700 dark:text-gray-300" />
                    <x-text-input id="name" 
                                 class="block mt-2 w-full px-4 py-3 rounded-lg border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700/50 dark:text-white" 
                                 type="text" 
                                 name="name" 
                                 :value="old('name')" 
                                 required 
                                 autofocus 
                                 autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('E-mail')" class="text-gray-700 dark:text-gray-300" />
                    <x-text-input id="email" 
                                 class="block mt-2 w-full px-4 py-3 rounded-lg border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700/50 dark:text-white" 
                                 type="email" 
                                 name="email" 
                                 :value="old('email')" 
                                 required 
                                 autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Senha')" class="text-gray-700 dark:text-gray-300" />
                    <x-text-input id="password" 
                                 class="block mt-2 w-full px-4 py-3 rounded-lg border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700/50 dark:text-white"
                                 type="password"
                                 name="password"
                                 required 
                                 autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" class="text-gray-700 dark:text-gray-300" />
                    <x-text-input id="password_confirmation" 
                                 class="block mt-2 w-full px-4 py-3 rounded-lg border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700/50 dark:text-white"
                                 type="password"
                                 name="password_confirmation" 
                                 required 
                                 autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div>
                    <button type="submit" 
                            class="w-full px-4 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:bg-indigo-700 transition duration-200 ease-in-out transform hover:-translate-y-1">
                        {{ __('Criar Conta') }}
                    </button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Já tem uma conta? 
                        <a href="{{ route('login') }}" 
                           class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                            Entrar
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
