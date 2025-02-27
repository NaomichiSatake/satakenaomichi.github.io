<div class="modal fade" id="show-users-{{ $post->id }}" tabindex="-1"
    aria-labelledby="deleteModalLabel-{{ $post->id }}" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content modal-secondary">
            <div class="modal-header border-secondary">
                <h3 class="h5 modal-title text-secondary">
                    <i class="fa-solid fa-post-slash"></i>Users Liked
                </h3>
            </div>
            <div class="modal-body">

                @foreach ($post->getUsersByPostId() as $user)
                    <div class="mb-2">
                        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">

                            @if ($user->avatar)
                                <img src="{{ $user->avatar }}" alt="User id {{ $user->id }}"
                                    class="avatar-sm rounded-circle">
                            @else
                                <i class="fa-solid fa-circle-user icon-sm"></i>
                            @endif


                            <span class="ms-4">{{ $user->name }}</span>
                            <br>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

</div>

{{-- <div class="modal fade" id="show-posts" tabindex="-1"
    aria-labelledby="deleteModalLabel-{{ $category->id }}" aria-hidden="true">


    <div class="modal-dialog">
        <div class="modal-content modal-secondary">
            <div class="modal-header border-secondary">
                <h3 class="h5 modal-title text-secondary">
                    <i class="fa-solid fa-post-slash"></i>Category
                </h3>
            </div>
            <div class="modal-body">

                @foreach ($isolatedPostsCount as $post)
                    <a href="{{ route('post.show', $post->id) }}">
                        <img src="{{ $post->image }}" alt="Category id {{ $post->post_id }}"
                            class="avatar-md">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div> --}}
