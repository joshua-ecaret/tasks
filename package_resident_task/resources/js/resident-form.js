document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("residentForm");
    if (!form) {
        return;
    }

    const residentId = form.getAttribute("data-resident-id");

    form.addEventListener("submit", async(e) => {
        e.preventDefault();

        const formData = new FormData(form);
        let url = "/residents";
        let method = "POST";
        let msg = "Resident created successfully!";

        if (residentId) {
            url = `/residents/${residentId}`;
            method = "POST";
            formData.append("_method", "PUT");
            msg = "Resident updated successfully!";
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
                        window.location.href = "/residents";
                    }
                });
            } else {
                console.error("Validation errors:", data.errors);
                const messages = Object.values(data.errors).flat().join("\n");
                 Swal.fire({
                    title: "Failed to create resident",
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
});
