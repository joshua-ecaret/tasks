const modal = document.getElementById('notificationsModal');
const clearBtn = document.getElementById('clearNotificationsBtn');

if (modal) {
    modal.addEventListener('shown.bs.modal', async function () {
        await delay(700);
        fetch('/notifications/mark-as-read', {
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                'Accept': 'application/json',
            },
        })
            .then(response => {
                if (!response.ok) throw new Error('Failed to mark notifications as read.');
                return response.json();
            })
            .then(data => {
                console.log('Marked as read:', data);
                // Optionally update alert classes
                document.querySelectorAll('#notificationsModal .alert-info').forEach(el => {
                    el.classList.remove('alert-info');
                    el.classList.add('alert-secondary');
                });
                // Remove unread count badge
                const badge = document.querySelector('.bi-bell ~ .badge');
                if (badge) badge.remove();
            })
            .catch(error => console.error('Error:', error));
    });
}

if (clearBtn) {
    clearBtn.addEventListener('click', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will delete all your notifications.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, clear all!',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/notifications/clear-all', {
                    method: 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        'Accept': 'application/json',
                    },
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Failed to clear notifications.');
                        return response.json();
                    })
                    .then(data => {
                        console.log('Cleared:', data);
                        const modalBody = modal.querySelector('.modal-body');
                        modalBody.innerHTML = `<p class="text-muted">No notifications available.</p>`;
                        // Remove badge
                        const badge = document.querySelector('.bi-bell ~ .badge');
                        if (badge) badge.remove();
                        Swal.fire('Cleared!', 'All notifications have been deleted.', 'success');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Something went wrong.', 'error');
                    });
            }
        });
    });
}

function delay(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}