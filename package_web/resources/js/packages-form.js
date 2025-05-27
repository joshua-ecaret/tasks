document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('packageForm');

    const checkbox = document.getElementById('apply_credit_rollover');
    const rolloverWrapper = document.getElementById('rolloverCreditsWrapper');

    function toggleRolloverInput() {
        if (checkbox.checked) {
            rolloverWrapper.style.display = 'block';
            rolloverWrapper.querySelector('input').setAttribute('required', 'required');
        } else {
            rolloverWrapper.style.display = 'none';
            rolloverWrapper.querySelector('input').removeAttribute('required');
        }
    }

    toggleRolloverInput();

    checkbox.addEventListener('change', toggleRolloverInput);

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch('/packages', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok) {
                alert('Package created successfully!');
                form.reset();
                window.location.href = '/packages';
            } else {
                console.error('Validation errors:', data.errors);

                // Flatten errors array
                const messages = Object.values(data.errors)
                    .flat()
                    .join('\n');

                alert('Failed to create package:\n' + messages);
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            alert('Something went wrong. Please try again.');
        }
    });

    const startDateInput = document.querySelector('input[name="start_date"]');
    const endDateInput = document.querySelector('input[name="end_date"]');

    function updateEndDateMin() {
        if (startDateInput.value) {
            const startDate = new Date(startDateInput.value);
            startDate.setDate(startDate.getDate() + 0);
            const minDateStr = startDate.toISOString().split('T')[0];
            endDateInput.min = minDateStr;

            if (endDateInput.value && endDateInput.value < minDateStr) {
                endDateInput.value = '';
            }
        } else {
            endDateInput.min = new Date().toISOString().split('T')[0];
        }
    }

    startDateInput.addEventListener('change', updateEndDateMin);

    const todayStr = new Date().toISOString().split('T')[0];
    if (!startDateInput.value) {
        startDateInput.value = todayStr;
    }

    const creditsTimeUnitSelect = document.querySelector('select[name="credits_time_unit"]');
    if (creditsTimeUnitSelect && !creditsTimeUnitSelect.value) {
        creditsTimeUnitSelect.value = 'Per Week';
    }

    updateEndDateMin();
});
