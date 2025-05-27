@extends('layouts.app')

@section('title', 'All Packages')

@section('header', 'Packages List')

@section('content')
  <div>
    <div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Available Packages</h2>
    <a href="/packages/create" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create New
      Package</a>
    </div>
  </div>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
<table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-700 rounded-lg">
  <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b border-gray-300 dark:border-gray-600">
      <tr>
      <th scope="col" class="px-6 py-3">Package name</th>
      <th scope="col" class="px-6 py-3">Credits</th>
      <th scope="col" class="px-6 py-3">Credits Time Unit</th>
      <th scope="col" class="px-6 py-3">Status</th>
      <th scope="col" class="px-6 py-3">Max Credit Rollover</th>
      <th scope="col" class="px-6 py-3"><span class="sr-only">Edit</span></th>
      <th scope="col" class="px-6 py-3"><span class="sr-only">Delete</span></th>
      </tr>
    </thead>
    <tbody id="package-table-body">
      @forelse ($packages as $package)
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
      <td class="px-6 py-4 font-medium text-gray-900  text-left dark:text-white">{{ $package->package_name }}</td>
      <td class="px-6 py-4">{{ $package->credits }}</td>
      <td class="px-6 py-4">{{ $package->credits_time_unit }}</td>
      <td class="px-6 py-4">{{ $package->status }}</td>
      <td class="px-6 py-4">{{ $package->max_rollover_credits ?? '-' }}</td>
      <td class="px-6 py-4 text-right">
      <a href="{{ route('packages.edit', $package->id) }}"
      class="font-medium text-blue-600 hover:underline">Edit</a>
      </td>
      <td class="px-6 py-4 text-right">
      <form method="POST" action="{{ route('packages.destroy', $package->id) }}">
      @csrf
      @method('DELETE')
      <button type="submit" class="font-medium text-red-600 hover:underline"
        onclick="return confirm('Are you sure?')">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7L5 7M6 7l1 12a2 2 0 002 2h6a2 2 0 002-2l1-12M10 11v6M14 11v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
  </svg>
      </button>
      </form>
      </td>
      </tr>
    @empty
      <tr>
      <td colspan="6" class="text-center py-4">No packages available.</td>
      </tr>
    @endforelse
    </tbody>

    </table>
  </div>
@endsection

@section('scripts')
  <script>
    // Custom JavaScript for this page
    console.log('Packages page loaded');
  </script>
@endsection