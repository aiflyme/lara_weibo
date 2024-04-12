<form action="{{ route('statuses.store') }}" method="POST">
    @include('shared._errors')
    @csrf
    <textarea class="form-control" rows="3" placeholder="聊聊新鲜事儿..." name="context">{{ old('context') }}</textarea>
    <div class="text-end">
        <button type="submit" class="btn btn-primary mt-3">发布</button>
    </div>
</form>
