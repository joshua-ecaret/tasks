<div class="btn-group" role="group" aria-label="Resident Actions">

    {{-- View Info Button --}}
    <a href="{{ route('residents.show', $id) }}" class="btn btn-sm " title="View Info">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#0d6efd" viewBox="0 0 16 16">
            <path d="M8 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1zm0 1.5a5.5 5.5 0 1 0 0 11A5.5 5.5 0 0 0 8 2.5z" />
            <path
                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 .933-.252 1.105-.598l.088-.416c-.2.176-.488.252-.686.252-.294 0-.396-.176-.33-.48l.738-3.468c.194-.897-.105-1.319-.808-1.319zm-.93-2.588a.9.9 0 1 0 0 1.8.9.9 0 0 0 0-1.8z" />
        </svg>

    </a>
    {{-- Edit Button --}}
    <a href="{{ route('residents.edit', $id) }}" class="btn  btn-sm" title="Edit Resident">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="blue" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" class="me-1" viewBox="0 0 24 24">
            <path d="M12 20h9" />
            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
        </svg>
    </a>

    {{-- Delete Button --}}
    <form action="{{ route('residents.destroy', $id) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete this resident?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn  btn-sm" title="Delete Resident">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="red" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="me-1" viewBox="0 0 24 24">
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
      onsubmit="return confirm('Are you sure you want to toggle this resident\'s status?')"
      style="display: inline-block;"
      title="Toggle Status"
>
    @csrf
    @method('PATCH')

    <div class="form-check form-switch">
        <input 
            class="form-check-input" 
            type="checkbox" 
            id="toggleStatusSwitch{{ $id }}" 
            name="status_toggle"
            onchange="this.form.submit()"
            {{ $status === 'Active' ? 'checked' : '' }}
        >
    </div>
</form>

</div>