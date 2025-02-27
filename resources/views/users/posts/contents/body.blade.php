{{-- Clickable image --}}
<div class="container p-0">
    <a href="{{ route('post.show', $post->id) }}">
        <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="w-100">
    </a>
</div>

<div class="card-body">
    {{-- heart button + no. of likes + categories --}}
    <div class="row align-items-center">
        <div class="col-auto">



            @if ($post->isLiked())
                <form action="{{ route('like.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm shadow-none p-0">
                        <i class="fa-solid fa-heart text-danger"></i> {{-- 赤いハート --}}
                    </button>

                </form>
            @else
                <form action="{{ route('like.store', $post->id) }}" method="post">
                    @csrf
                    <button class="btn btn-sm shadow-none p-0">

                        <i class="fa-regular fa-heart"></i> {{-- 輪郭のみのハート --}}
                    </button>
                </form>
            @endif



        </div>

        <button class="col-auto px-0 border-0 bg-transparent @if ($post->likes->count() >= 1) text-danger @else text-dark @endif"
            @if ($post->likes->count() == 0) disabled @endif data-bs-toggle="modal"
            data-bs-target="#show-users-{{ $post->id }}">

                <span class="">{{ $post->likes->count() }}</span>

        </button>
        @include('users.posts.contents.modals.showLikers')


        <div class="col text-end">
            @foreach ($post->categoryPost as $category_post)
                <div class="badge bg-secondary bg-opacity-50">
                    {{ $category_post->category->name }}
                </div>
            @endforeach
        </div>
    </div>


    {{-- owner + description --}}
    <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark fw-bold">
        {{ $post->user->name }}
    </a>
    &nbsp;
    <p class="d-inline fw-light">{{ $post->description }}</p>
    <p class="text-uppercase text-muted xsmall">{{ date('M d,Y', strtotime($post->created_at)) }}</p>

    {{-- Include comments here --}}

    @include('users.posts.contents.comments')
</div>
