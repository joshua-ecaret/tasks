<div class="btn-group" role="group" aria-label="Actions">
    <a href="{{ route('packages.edit', $id) }}" class="btn  btn-sm" title="Edit Package">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="blue" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" class="me-1" viewBox="0 0 24 24">
            <path d="M12 20h9" />
            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
        </svg>
    </a>
    <form action="{{ route('packages.destroy', $id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-sm btn-delete" title="Delete Package">
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


</div>