<div class="btn-group" role="group" aria-label="Actions">
    <a href="{{ route('residents.edit', $id) }}" class="btn btn-sm btn-primary">Edit</a>
    <form action="{{ route('residents.destroy', $id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
</div>
