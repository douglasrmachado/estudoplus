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
}); 