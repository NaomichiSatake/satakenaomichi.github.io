@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <div class="row gx-5">
        <div class="col-8">
            {{-- POSTS --}}
            @forelse ($home_posts as $post)
                <div class="card mb-4">
                    @include('users.posts.contents.title')
                    @include('users.posts.contents.body')
                </div>
                {{-- <div class="card w-75">
                <div class="card-header">
                    @if ($post->user->avatar)<div class="">{{$post->user->avatar}}</div>
                    @else <i class="fa-solid fa-user"></i>
                    @endif

                    {{$post->user->name}}


                </div>
            </div>

            <div class="card-body ">
                <img src="{{$post->image}}" alt="" width="200px">
            </div>

            <div class="card-footer">
                {{-- heart iconn --}}
                {{-- @foreach ($post->categoryPost as $category)<span class="text-white bg-secondary p-1 rounded me-1">{{$category->category->name}}</span>@endforeach

                 <span class="fw-bold  card-subtitle">{{$post->user->name}}</span> {{$post->description}}

            </div> --}}

            @empty
                <div class="text-center">
                    <h2>Share Posts</h2>
                    <p class="text-secondary">When you share your photos, they'll appear on your profile</p>
                    <a href="{{ route('post.create') }}" class="text-decoration-none">Share your first photo</a>
                </div>
            @endforelse
        </div>
        <div class="col-4">

            {{-- Profile Overview --}}
            <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">
                <div class="col-auto">
                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="">
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                                class="rounded-circle avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                        @endif
                    </a>
                </div>
                <div class="col-auto ps-0">
                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="text-decoration-none text-dark fw-bold">
                        {{ Auth::user()->name }}
                    </a>
                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                </div>
            </div>

            @if ($suggested_users)
                <div class="row">
                    <div class="col-auto">
                        <p class="fw-bold text-secondary">Suggestions For You</p>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('follow.show') }}"
                            class="fw-bold text-dark text-decoration-none">See all</a>
                    </div>
                </div>

                @foreach ($suggested_users as $user)
                    <div class="row align-items-center mb-3">
                        <div class="col-auto">
                            <a href="{{ route('profile.show', $user->id) }}" class="">
                                @if ($user->avatar)
                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                                        class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col-auto text-trancate">
                            <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">
                                {{ $user->name }}
                            </a>

                        </div>
                        <div class="col-auto">
                            <form action="{{ route('follow.store', $user->id) }}" method="post">
                                @csrf
                                <button class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

@endsection
