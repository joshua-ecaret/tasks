document.addEventListener("DOMContentLoaded", () => {
    const checkbox = document.getElementById("apply_credit_rollover");
    const rolloverWrapper = document.getElementById("rolloverCreditsWrapper");

    if (checkbox && rolloverWrapper) {
        function toggleRolloverInput()
        {
            if (checkbox.checked) {
                rolloverWrapper.style.display = "block";
                rolloverWrapper
                    .querySelector("input")
                    .setAttribute("required", "required");
            } else {
                rolloverWrapper.style.display = "none";
                rolloverWrapper
                    .querySelector("input")
                    .removeAttribute("required");
            }
        }

        toggleRolloverInput();
        checkbox.addEventListener("change", toggleRolloverInput);
    }

    const form = document.getElementById("packageForm");
    if (!form) {
        return;
    }
    form.addEventListener("submit", async(e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const packageId = form.getAttribute("data-package-id");
        // If updating, spoof PUT method
        let url = "/packages";
        let method = "POST";
        let msg = "Package created successfully!";
        if (packageId) {
            url = `/packages/${packageId}`;
            method = "POST"; // Laravel expects POST with _method=PUT to spoof PUT
            formData.append("_method", "PUT");
            msg = "Package updated successfully!";
        }
        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: formData,
            });

            const data = await response.json();

            if (response.ok) {
                Swal.fire({
                    title: "Success",
                    text: msg,
                    icon: "success",
                    confirmButtonText: "OK",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.reset();
                        window.location.href = "/packages";
                    }
                });
            } else {
                console.error("Validation errors:", data.errors);

                const messages = Object.values(data.errors).flat().join("\n");

                Swal.fire({
                    title: "Failed to create package",
                    text: messages,
                    icon: "error",
                    confirmButtonText: "OK",
                });
            }
        } catch (error) {
            console.error("Error submitting form:", error);

            Swal.fire({
                title: "Unexpected Error",
                text: "Something went wrong. Please try again.",
                icon: "error",
                confirmButtonText: "OK",
            });
        }
    });

    const startDateInput = document.querySelector('input[name="start_date"]');
    const endDateInput = document.querySelector('input[name="end_date"]');

function updateEndDateMin()
{
    if (startDateInput.value) {
        const startDate = new Date(startDateInput.value);
        startDate.setDate(startDate.getDate() + 0);
        const minDateStr = startDate.toISOString().split("T")[0];
        endDateInput.min = minDateStr;

        if (endDateInput.value && endDateInput.value < minDateStr) {
            endDateInput.value = "";
        }
    } else {
        endDateInput.min = new Date().toISOString().split("T")[0];
    }
}

    startDateInput.addEventListener("change", updateEndDateMin);

    const todayStr = new Date().toISOString().split("T")[0];
if (!startDateInput.value) {
    startDateInput.value = todayStr;
}

    const creditsTimeUnitSelect = document.querySelector(
        'select[name="credits_time_unit"]'
    );
if (creditsTimeUnitSelect && !creditsTimeUnitSelect.value) {
    creditsTimeUnitSelect.value = "Per Week";
}

    updateEndDateMin();

     document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
});
