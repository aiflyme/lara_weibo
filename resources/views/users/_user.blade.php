<div class="list-group-item">
    <img class="me-3" src="{{ $user->gravatar() }}" alt="{{ $user->name }}" width=32>
    {{ $user->id }}
    <a href="{{ route('user.show', $user) }}">
        {{ $user->name }}
    </a>
    @can('destroy', $user)
    <form action="{{ route('user.destroy', $user->id) }}" method="post" class="float-end">
       @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger delete-btn">delete</button>
    </form>
    @endcan

</div>
