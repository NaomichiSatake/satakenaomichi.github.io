<div class="mt-3">
    {{-- show all comments here --}}

    @if ($post->comments->isNotEmpty())

        <ul class="list-group mt-2">
            <hr>
            @foreach ($post->comments->take(3) as $comment)
                <li class="list-group-item border-0 p-0 mb-2">
                    <a href="{{ route('profile.show', $comment->user->id) }}"
                        class="text-decoration-none text-dark fw-bold">{{ $comment->user->name }}</a>
                    &nbsp;
                    <p class="d-inline fw-light">{{ $comment->body }}</p>

                    <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <span
                            class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($post->created_at)) }}</span>
                        {{-- if the auth user is The Owner of the comment show a delete btn --}}
                        @if (Auth::user()->id === $comment->user->id)
                            &middot;
                            <button class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                        @endif
                    </form>
                </li>
            @endforeach

            @if ($post->comments->count() > 3)
                <li class="list-group-item border-0 px-0 pt-0">
                    <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none small">
                        View All {{ $post->comments->count() }} comments
                    </a>
                </li>
            @endif
        </ul>
    @endif

    <form action="{{ route('comment.store', $post->id) }}" method="post">
        @csrf

        <div class="input-group">
            <textarea name="body{{ $post->id }}" id="" rows="1" class="form-control form-control-sm"
                placeholder="Add a comment...">{{ old('body' . $post->id) }}</textarea>
            <button class="btn btn-secondary btn-sm">Post</button>
        </div>

        {{-- Error --}}
        @error('body' . $post->id)
            <div class="small text-danger">{{ $message }}</div>
        @enderror
    </form>




</div>
