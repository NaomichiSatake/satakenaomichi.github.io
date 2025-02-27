@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')
    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-primary text-secondary">
            <tr>
                <th></th>
                <th></th>
                <th>Category</th>
                <th>Owner</th>
                <th>Created At</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_posts as $post)
                <tr>
                    <td>
                        <span>{{ $post->id }}</span>
                    </td>
                    <td>

                        <img src="{{ $post->image }}" alt="{{ $post->id }}" class="d-block mx-auto image-lg">
                    </td>
                    <td>
                        @foreach ($post->categoryPost as $category)
                            <div class="badge bg-secondary bg-opacity-50">
                                {{ $category->category->name }}
                            </div>
                        @endforeach
                    </td>
                    <td><a href="{{ route('profile.show', $post->user->id) }}" class="text-dark text-decoration-none">{{ $post->user->name }}</a></td>

                    <td>{{ $post->created_at }}</td>
                    <td>

                        @if ($post->trashed())
                            <i class="fa-solid fa-circle-minus text-secondary"></i> &nbsp; Invislble
                        @else
                            <i class="fa-solid fa-circle text-primary"></i> &nbsp; Visible
                        @endif
                    </td>
                    <td>
                        {{-- @if (post()->id !== $post->id) --}}
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if ($post->trashed())
                                    <button class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#activate-post-{{ $post->id }}">
                                        <i class="fa-solid fa-post-check"></i> Visualize {{ $post->id }}
                                    </button>
                                @else
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                        data-bs-target="#deactivate-post-{{ $post->id }}">
                                        <i class="fa-solid fa-post-slash"></i> Invisualize {{ $post->id }}
                                    </button>
                                @endif
                            </div>

                        </div>

                        {{-- Include a modal here --}}
                        @include('admin.posts.modal.status')


                        {{-- @endif --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $all_posts->links() }}
    </div>
@endsection
