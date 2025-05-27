<form id="packageForm" class="max-w-xl mx-auto">
    <x-input-floating type="text" name="package_name" label="Package Name" required />
    <div class="grid md:grid-cols-[2fr_1fr] md:gap-6 w-full">
        <x-input-floating type="number" name="credits" label="Credits" required />
        <x-input-select name="credits_time_unit" label="Credits Time Unit" :options="[
        'Per Month' => 'Per Month',
        'Per Week' => 'Per Week',
    ]" :required="true" />
    </div>

    <x-input-select name="status" label="Status" :options="[
        'Active' => 'Active',
        'Inactive' => 'Inactive',
        'Draft' => 'Draft',
    ]" :required="true" />

    <fieldset>
        <legend class="sr-only">Credit Rollover</legend>

        <x-checkbox id="apply_credit_rollover" name="apply_credit_rollover" label="Apply Credit Rollover" />

        <div id="rolloverCreditsWrapper">
            <x-input-floating type="number" name="max_rollover_credits" label="Max Rollover Credit" required />
        </div>
    </fieldset>

    <div class="grid md:grid-cols-2 md:gap-6">
        <x-input-date name="start_date" label="Start Date" required min="{{ date('Y-m-d') }}" />

        <x-input-date name="end_date" label="End Date" required min="{{ date('Y-m-d') }}" />


    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto
         px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>
<script>
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
                const response = await fetch('/api/packages', {
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

        // Set initial min for end date as today + 1 (if you want end_date > start_date)
        function updateEndDateMin() {
            if (startDateInput.value) {
                const startDate = new Date(startDateInput.value);
                // add 1 day to start date for strict 'after' condition
                startDate.setDate(startDate.getDate() + 0);

                const minDateStr = startDate.toISOString().split('T')[0];
                endDateInput.min = minDateStr;

                // Clear end_date if it is before minDateStr
                if (endDateInput.value && endDateInput.value < minDateStr) {
                    endDateInput.value = '';
                }
            } else {
                // If no start date, allow end date from today
                endDateInput.min = new Date().toISOString().split('T')[0];
            }
        }

        startDateInput.addEventListener('change', updateEndDateMin);

        // Initialize on page load in case of old values
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
</script>