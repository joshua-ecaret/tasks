<x-layout>
    <x-slot:header> <a href="/packages">Packages</a>
    </x-slot:header>

    <div>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Available Packages</h2>
            <a href="/packages/create" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create New
                Package</a>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Package name</th>
                    <th scope="col" class="px-6 py-3">Credits</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Max Credit Rollover</th>
                    <th scope="col" class="px-6 py-3"><span class="sr-only">Edit</span></th>
                    <th scope="col" class="px-6 py-3"><span class="sr-only">Delete</span></th>
                </tr>
            </thead>
            <tbody id="package-table-body">
                <tr>
                    <td colspan="5" class="text-center py-4">Loading...</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        async function loadPackages() {
            const tbody = document.getElementById('package-table-body');
            tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4">Loading...</td></tr>';

            try {
                const response = await fetch('/api/packages', {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await response.json();
                const packages = data.data;

                if (packages.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4">No packages found.</td></tr>';
                    return;
                }

                tbody.innerHTML = '';

                packages.forEach(pkg => {
                    const row = `
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${pkg.name}
                            </th>
                            <td class="px-6 py-4">${pkg.credits}</td>
                            <td class="px-6 py-4">${pkg.status}</td>
                            <td class="px-6 py-4">${pkg.apply_credit_rollover ? pkg.max_rollover_credits : 'N/A'}</td>
                            <td class="px-6 py-4">
                                <a href="/packages/update/${pkg.id}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                            <td class="px-6 py-4">
                                <button
                                    onclick="deletePackage(${pkg.id}, this)"
                                    class="text-red-600 hover:text-red-800"
                                    aria-label="Delete package"
                                    title="Delete package"
                                >
<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7L5 7M6 7l1 12a2 2 0 002 2h6a2 2 0 002-2l1-12M10 11v6M14 11v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
  </svg>
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });

            } catch (error) {
                console.error(error);
                tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-red-500">Error loading packages</td></tr>';
            }
        }

        loadPackages();

        async function deletePackage(id, buttonElement) {
            if (!confirm('Are you sure you want to delete this package?')) {
                return;
            }

            try {
                const response = await fetch(`/api/packages/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (response.ok) {
                    alert('Package deleted successfully.');

                    // Remove the row from the table
                    // Assuming button is inside the <td> inside the <tr>
                    const row = buttonElement.closest('tr');
                    if (row) row.remove();

                } else {
                    const data = await response.json();
                    alert('Failed to delete package: ' + (data.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Delete error:', error);
                alert('Error deleting package, please try again.');
            }
        }
    </script>
</x-layout>