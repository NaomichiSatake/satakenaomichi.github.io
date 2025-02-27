@extends('layouts.app')

@section('title', 'Followerrs')

@section('content')
    @include('users.profile.header')

    <div style="margin-top: 100px">
        @if ($user->following->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-4">
                    <h3 class="text-muted text-center">Followers</h3>

                    @foreach ($user->following as $user)
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <a href="{{ route('profile.show', $user->following->id) }}">
                                    @if ($user->following->avatar)
                                        <img src="{{ $user->following->avatar }}" alt="{{ $user->following->name }}"
                                            class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col ps-0 text-trancate">
                                <a href="{{ route('profile.show', $user->following->id) }}"
                                    class="text-decoration-none text-dark fw-bold">
                                    {{ $user->following->name }}
                                </a>
                            </div>
                            <div class="col-auto text-end">
                                <form action="{{ route('follow.destroy', $user->following->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="border-0 bg-transparent p-0 text-secondary btn-sm">Following</button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <h3 class="text-muted text-center">No Followers Yet</h3>
        @endif
    </div>

@endsection
