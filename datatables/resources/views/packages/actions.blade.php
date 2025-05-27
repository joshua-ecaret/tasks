<a href="{{ route('packages.edit', $row->id) }}" class="btn btn-sm btn-primary">Edit</a>

<form action="{{ route('packages.destroy', $row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
</form>
