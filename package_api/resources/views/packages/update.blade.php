<x-layout>
  <x-slot:header>
    <a href="/packages">Packages</a> / Update Package
  </x-slot:header>

  <x-form id="packageForm" />
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      const packageId = @json($packageId); // or pass from blade

      const form = document.getElementById('packageForm');

      form.reset();
      try {
        const response = await fetch(`/api/packages/${packageId}`, {
          headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });

        if (!response.ok) throw new Error('Failed to load package data');

        const data = await response.json();
        console.log(data);

        // Now populate your form inputs based on data.data (assuming standard Laravel API Resource format)
        const pkg = data.data;

        form.querySelector('input[name="package_name"]').value = pkg.name || '';
        form.querySelector('input[name="credits"]').value = pkg.credits || '';
        form.querySelector('select[name="credits_time_unit"]').value = pkg.time_unit || '';  // map time_unit to credits_time_unit
        form.querySelector('select[name="status"]').value = pkg.status || '';
        form.querySelector('input[name="apply_credit_rollover"]').checked = Boolean(pkg.apply_credit_rollover);
        form.querySelector('input[name="max_rollover_credits"]').value = pkg.max_rollover_credits || '';
        form.querySelector('input[name="start_date"]').value = pkg.start_date || '';
        form.querySelector('input[name="end_date"]').value = pkg.end_date || '';


        // Trigger any JS toggle you have to show/hide max_rollover_credits field
        form.querySelector('#apply_credit_rollover').dispatchEvent(new Event('change'));

        const checkbox = document.getElementById('apply_credit_rollover');
        const rolloverWrapper = document.getElementById('rolloverCreditsWrapper');

        function toggleRolloverInput() {
            if (Boolean(pkg.apply_credit_rollover)) {
                checkbox.checked = true;
                rolloverWrapper.style.display = 'block';
                rolloverWrapper.querySelector('input').setAttribute('required', 'required');
            } else {
                rolloverWrapper.style.display = 'none';
                rolloverWrapper.querySelector('input').removeAttribute('required');
            }
        }

        toggleRolloverInput();
      } catch (error) {
        console.error(error);
        alert('Failed to load package data.');
      }
    
    });
  </script>
</x-layout>