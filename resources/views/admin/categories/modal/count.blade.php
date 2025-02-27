<div class="modal fade" id="show-posts-{{ $category->id }}" tabindex="-1"
    aria-labelledby="deleteModalLabel-{{ $category->id }}" aria-hidden="true">
    {{-- Deactivate --}}

    <div class="modal-dialog">
        <div class="modal-content modal-secondary">
            <div class="modal-header border-secondary">
                <h3 class="h5 modal-title text-secondary">
                    <i class="fa-solid fa-post-slash"></i>Category
                </h3>
            </div>
            <div class="modal-body">

                @foreach ($category->categoryPost as $categoryPost)
                    <a href="{{ route('post.show', $categoryPost->post_id) }}">
                        <img src="{{ $categoryPost->post->image }}" alt="Category id {{ $categoryPost->post_id }}"
                            class="avatar-md">
                    </a>
                @endforeach
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="show-posts" tabindex="-1"
    aria-labelledby="deleteModalLabel-{{ $category->id }}" aria-hidden="true">
    {{-- Deactivate --}}

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
</div>
