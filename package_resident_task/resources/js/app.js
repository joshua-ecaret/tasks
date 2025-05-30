import './bootstrap';
import 'laravel-datatables-vite';
import './packages-form.js';
import './resident-form.js';
import Swal from 'sweetalert2';
import './notifications.js'

// function fetchNotifications() {
//     fetch('/notifications/unread', {
//         headers: {
//             'Accept': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
//         },
//     })
//     .then(res => res.json())
//     .then(data => {

//         // Update your UI with notifications count or list
//         console.log('Unread notifications from model:', data);
//     })
//     .catch(console.error);
// }

// // Call immediately and then every 15 seconds
// fetchNotifications();
// setInterval(fetchNotifications, 5000);
