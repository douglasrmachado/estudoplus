@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}>

@if($attributes->get('type') === 'date')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('{{ $attributes->get('id') }}');
        if (input) {
            // Função para validar a data
            function validateDate(value) {
                if (!value) return false;
                
                const parts = value.split('-');
                if (parts.length !== 3) return false;
                
                const year = parseInt(parts[0]);
                const month = parseInt(parts[1]);
                const day = parseInt(parts[2]);
                
                // Validação do ano (2025 ou posterior)
                if (year < 2025) return false;
                
                // Validação do mês (1-12)
                if (month < 1 || month > 12) return false;
                
                // Validação do dia (1-31, considerando meses)
                const daysInMonth = new Date(year, month, 0).getDate();
                if (day < 1 || day > daysInMonth) return false;
                
                return true;
            }
            
            // Função para formatar a data
            function formatDate(value) {
                if (!value) return '';
                
                const parts = value.split('-');
                if (parts.length !== 3) return value;
                
                return `${parts[2]}/${parts[1]}/${parts[0]}`;
            }
            
            input.addEventListener('input', function(e) {
                const value = e.target.value;
                
                if (!validateDate(value)) {
                    this.setCustomValidity('Por favor, insira uma data válida. O ano deve ser 2025 ou posterior.');
                } else {
                    this.setCustomValidity('');
                }
            });
            
            input.addEventListener('change', function(e) {
                const value = e.target.value;
                if (value) {
                    const formattedDate = formatDate(value);
                    input.setAttribute('data-display', formattedDate);
                }
            });
        }
    });
</script>
@endif
