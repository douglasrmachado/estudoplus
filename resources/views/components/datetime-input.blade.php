@props(['disabled' => false])

<input 
    type="datetime-local" 
    {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}
    step="3600"
    pattern="\d{4}-\d{2}-\d{2}T\d{2}:\d{2}"
    maxlength="16"
    oninvalid="this.setCustomValidity('A data e hora de início devem ser iguais ou posteriores a agora.')"
    oninput="this.setCustomValidity('')">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('{{ $attributes->get('id') }}');
        if (input) {
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
            });
        }
    });
</script> 