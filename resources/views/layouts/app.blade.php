<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const datetimeInputs = document.querySelectorAll('input[type="datetime-local"]');
                datetimeInputs.forEach(input => {
                    input.setAttribute('step', '3600');
                    input.setAttribute('pattern', '\\d{4}-\\d{2}-\\d{2}T\\d{2}:\\d{2}');
                    input.setAttribute('maxlength', '16');
                    
                    input.addEventListener('input', function(e) {
                        let value = e.target.value;
                        if (value.length > 0) {
                            let parts = value.split('T');
                            let dateParts = parts[0].split('-');
                            if (dateParts[0].length > 4) {
                                dateParts[0] = dateParts[0].substring(0, 4);
                                parts[0] = dateParts.join('-');
                                e.target.value = parts.join('T');
                            }
                        }
                        
                        const minDateTime = input.getAttribute('min');
                        if (minDateTime && new Date(value) < new Date(minDateTime)) {
                            input.setCustomValidity('A data e hora de início devem ser iguais ou posteriores a agora.');
                        } else {
                            input.setCustomValidity('');
                        }
                    });
                });

                const dateInputs = document.querySelectorAll('input[type="date"]');
                
                dateInputs.forEach(input => {
                    input.addEventListener('input', function(e) {
                        const value = e.target.value;
                        if (value) {
                            const parts = value.split('-');
                            if (parts.length === 3) {
                                const year = parseInt(parts[0]);
                                const month = parseInt(parts[1]);
                                const day = parseInt(parts[2]);
                                
                                let message = '';
                                
                                if (year < 2025) {
                                    message = 'O ano deve ser 2025 ou posterior.';
                                } else if (month < 1 || month > 12) {
                                    message = 'O mês deve estar entre 01 e 12.';
                                } else {
                                    const daysInMonth = new Date(year, month, 0).getDate();
                                    if (day < 1 || day > daysInMonth) {
                                        message = `O dia deve estar entre 01 e ${daysInMonth} para o mês selecionado.`;
                                    }
                                }
                                
                                this.setCustomValidity(message);
                            }
                        }
                    });
                });
            });
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
