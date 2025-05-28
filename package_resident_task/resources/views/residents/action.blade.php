<div class="btn-group" role="group" aria-label="Resident Actions">
   
    {{-- View Info Button --}}
     <a href="{{ route('residents.show', $id) }}" class="btn btn-sm btn-info" title="View Info">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" stroke="none"/>
            <line x1="12" y1="16" x2="12" y2="12" stroke="white" stroke-width="2" />
            <circle cx="12" cy="8" r="1" fill="white" />
        </svg>
    </a>
    {{-- Edit Button --}}
    <a href="{{ route('residents.edit', $id) }}" class="btn  btn-sm" title="Edit Resident">
        <svg xmlns="http://www.w3.org/2000/svg"
             width="16" height="16"
             fill="none" stroke="blue" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round"
             class="me-1" viewBox="0 0 24 24">
            <path d="M12 20h9" />
            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
        </svg>
    </a>

    {{-- Delete Button --}}
    <form action="{{ route('residents.destroy', $id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this resident?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn  btn-sm" title="Delete Resident">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="16" height="16"
                 fill="none" stroke="red" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round"
                 class="me-1" viewBox="0 0 24 24">
                <polyline points="3 6 5 6 21 6" />
                <path d="M19 6l-.867 12.142A2 2 0 0 1 16.138 20H7.862a2 2 0 0 1-1.995-1.858L5 6m5 0V4
                          a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2" />
                <line x1="10" y1="11" x2="10" y2="17" />
                <line x1="14" y1="11" x2="14" y2="17" />
            </svg>
        </button>
    </form>
        
    {{-- Toggle Status Button --}}
    <form action="{{ route('residents.toggleStatus', $id) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to toggle this resident\'s status?')">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-sm btn-warning" title="Toggle Status">
            Toggle Status
        </button>
    </form>

</div>
