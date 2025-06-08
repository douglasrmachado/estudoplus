<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-b from-indigo-50 to-white dark:from-gray-900 dark:to-gray-800">
        <div class="-mt-32 mb-8 text-center">
            <div class="text-8xl mb-4">
                <svg class="w-24 h-24 mx-auto text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-indigo-600 dark:text-indigo-400">Estudo+</h1>
        </div>

        <div class="w-full sm:max-w-md px-6 py-8 bg-gradient-to-b from-indigo-50/50 to-white/50 dark:from-gray-800/50 dark:to-gray-900/50 backdrop-blur-sm shadow-xl overflow-hidden sm:rounded-xl">
            <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-4">Recuperar Senha</h2>

            <div class="mb-8 text-sm text-gray-600 dark:text-gray-400 text-center">
                {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um link para você criar uma nova senha.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('E-mail')" class="text-gray-700 dark:text-gray-300" />
                    <x-text-input id="email" 
                                 class="block mt-2 w-full px-4 py-3 rounded-lg border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700/50 dark:text-white" 
                                 type="email" 
                                 name="email" 
                                 :value="old('email')" 
                                 required 
                                 autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <button type="submit" 
                            class="w-full px-4 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:bg-indigo-700 transition duration-200 ease-in-out transform hover:-translate-y-1">
                        {{ __('Enviar Link de Recuperação') }}
                    </button>
                </div>

                <div class="text-center mt-6">
                    <a href="{{ route('login') }}" 
                       class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                        Voltar para o login
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
