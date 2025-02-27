@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')

    <div class="container my-4">
        <div class="row">
            <!-- Add Category Input -->
            <div class="col-md-6">
                <form action="{{ route('admin.categories.store') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Add a category..."
                            aria-label="Add a category">

                    </div>
            </div>
            <div class="col-2 text-start">
                <button class="btn btn-primary" type="submit">+ Add</button>
            </div>
            </form>
        </div>

        <!-- Categories Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-warning text-center">
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>COUNT</th>
                        <th>LAST UPDATED</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_categories as $category)
                        <tr>
                            <td class="text-center">{{ $category->id }}</td>
                            <td class="text-center">{{ $category->name }}</td>

                            <td class="text-center">
                                <button
                                    class="border-0 bg-transparent text-center @if ($category->categoryPost->count() >= 1) text-danger @else text-dark @endif"
                                    @if ($category->categoryPost->count() == 0) disabled @endif data-bs-toggle="modal"
                                    data-bs-target="#show-posts-{{ $category->id }}">{{ $category->categoryPost->count() }}</button>
                            </td>



                            <td class="text-center">{{ $category->created_at }}</td>

                            <td class="text-center">
                                <button class="btn btn-outline-warning" data-bs-toggle="modal"
                                    data-bs-target="#edit-category-{{ $category->id }}">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete-category-{{ $category->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                @include('admin.categories.modal.count')
                            </td>

                        </tr>
                    @endforeach

                    <tr>
                        <td class="text-center" colspan="2">
                            Uncategorized
                            <p class="form-text">Hidden posts are not included</p>
                        </td>

                        <td>
                            <button
                            class="border-0 bg-transparent @if ($isolatedPostsCount->count() >= 1) text-danger @else text-dark @endif"
                            @if ($isolatedPostsCount->count() == 0) disabled @endif data-bs-toggle="modal"
                            data-bs-target="#show-posts">{{ $isolatedPostsCount->count() }}</button>
                        </td>
                        <td></td>
                        <td></td>

                    </tr>

                    {{-- Include a modal here --}}
                    @include('admin.categories.modal.status')
                </tbody>
            </table>
        </div>
    </div>

@endsection
