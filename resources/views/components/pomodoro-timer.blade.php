@props(['duration' => 25])

<div x-data="{
    duration: {{ $duration }},
    timeLeft: {{ $duration * 60 }},
    isRunning: false,
    timer: null,
    shortBreak: 5,
    longBreak: 15,
    pomodoroCount: 0,
    mode: 'pomodoro',
    showNotification: false,
    
    startTimer() {
        if (!this.isRunning) {
            this.isRunning = true;
            this.timer = setInterval(() => {
                if (this.timeLeft > 0) {
                    this.timeLeft--;
                } else {
                    this.stopTimer();
                    this.showNotification = true;
                    setTimeout(() => this.showNotification = false, 5000);
                    if (this.mode === 'pomodoro') {
                        this.pomodoroCount++;
                        if (this.pomodoroCount % 4 === 0) {
                            this.setMode('longBreak');
                        } else {
                            this.setMode('shortBreak');
                        }
                    } else {
                        this.setMode('pomodoro');
                    }
                }
            }, 1000);
        }
    },

    stopTimer() {
        this.isRunning = false;
        if (this.timer) {
            clearInterval(this.timer);
            this.timer = null;
        }
    },

    resetTimer() {
        this.stopTimer();
        this.timeLeft = this.duration * 60;
    },

    formatTime() {
        const minutes = Math.floor(this.timeLeft / 60);
        const seconds = this.timeLeft % 60;
        return `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    },

    setMode(newMode) {
        this.mode = newMode;
        this.stopTimer();
        
        switch(newMode) {
            case 'pomodoro':
                this.duration = {{ $duration }};
                break;
            case 'shortBreak':
                this.duration = this.shortBreak;
                break;
            case 'longBreak':
                this.duration = this.longBreak;
                break;
        }
        
        this.timeLeft = this.duration * 60;
    }
}" 
x-init="$watch('mode', value => {
    document.title = `${formatTime()} - ${value === 'pomodoro' ? 'Tempo de Estudo' : 'Tempo de Descanso'}`;
})"
class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    
    <!-- Notificação -->
    <div x-show="showNotification" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="mb-4 p-4 bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-200 rounded-lg text-center">
        <p x-text="mode === 'pomodoro' ? 'Tempo de estudo concluído! Hora de uma pausa.' : 'Pausa concluída! Vamos voltar aos estudos?'"></p>
    </div>

    <div class="text-center mb-8">
        <div class="flex justify-center space-x-4 mb-6">
            <button @click="setMode('pomodoro')" 
                    :class="{'bg-indigo-600 text-white': mode === 'pomodoro', 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300': mode !== 'pomodoro'}"
                    class="px-4 py-2 rounded-lg font-medium transition-colors">
                Pomodoro
            </button>
            <button @click="setMode('shortBreak')"
                    :class="{'bg-indigo-600 text-white': mode === 'shortBreak', 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300': mode !== 'shortBreak'}"
                    class="px-4 py-2 rounded-lg font-medium transition-colors">
                Pausa Curta
            </button>
            <button @click="setMode('longBreak')"
                    :class="{'bg-indigo-600 text-white': mode === 'longBreak', 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300': mode !== 'longBreak'}"
                    class="px-4 py-2 rounded-lg font-medium transition-colors">
                Pausa Longa
            </button>
        </div>

        <div class="text-6xl font-bold text-gray-800 dark:text-gray-200 mb-8" x-text="formatTime()">
            25:00
        </div>

        <div class="flex justify-center space-x-4">
            <button @click="startTimer()" 
                    x-show="!isRunning"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Iniciar
            </button>

            <button @click="stopTimer()" 
                    x-show="isRunning"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-medium flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Pausar
            </button>

            <button @click="resetTimer()" 
                    class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Reiniciar
            </button>
        </div>
    </div>

    <div class="text-center text-sm text-gray-600 dark:text-gray-400">
        <p>Pomodoros completados: <span x-text="pomodoroCount" class="font-medium">0</span></p>
    </div>
</div> 