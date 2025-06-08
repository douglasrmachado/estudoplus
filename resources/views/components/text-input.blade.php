@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}
       @if($attributes->get('required'))
       oninvalid="this.setCustomValidity('Por favor, preencha este campo.')"
       oninput="this.setCustomValidity('')"
       @endif>

@if($attributes->get('type') === 'date')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('{{ $attributes->get('id') }}');
        if (input) {
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
        }
    });
</script>
@endif
