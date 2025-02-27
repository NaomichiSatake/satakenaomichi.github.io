@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="container">
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h4>Category<span class="text-muted">(up to 3)</span></h4>

            <div class="mt-3">
                {{-- <input type="checkbox" name="category" id="travel" value="travel">
                <label for="travel">Travel</label>
                <input type="checkbox" name="category" id="food" value="food">
                <label for="food">Food</label>
                <input type="checkbox" name="category" id="lifestyle" value="lifestyle">
                <label for="lifestyle">Lifestyle</label>
                <input type="checkbox" name="category" id="music" value="music">
                <label for="music">Music</label>
                <input type="checkbox" name="category" id="career" value="career">
                <label for="career">Career</label>
                <input type="checkbox" name="category" id="movie" value="movie">
                <label for="movie">Movie</label> --}}

                {{-- Display all the categories using foreach --}}
                @forelse ($all_categories as $category)
                    <input type="checkbox" name="category[]" id="{{ $category->id }}" value="{{ $category->id }}"
                        class="category-checkbox">
                    <label for="{{ $category->id }}"class="me-1">{{ $category->name }}</label>

                @empty
                    {{-- <p>{{ $message }}</p> --}}
                @endforelse

                @error('category')
                    {{-- <div class="text-danger small">{{ $message }}</div> --}}
                @enderror

            </div>

            <h4 class="mt-3">Description</h4>
            <textarea name="description" id="description" cols="30" rows="10" placeholder="Wath's on your mind"
                class="form-control">{{ old('description') }}</textarea>

            @error('description')
                {{-- <div class="text-danger small">{{ $message }}</div> --}}
            @enderror

            <h4 class="mt-3">Image</h4>
            <input type="file" name="image" id="image" class="form-control">
            <p class="text-lighter">Acceptable formats:jpeg,jpg,png,gif only</p>
            <p class="text-lighter mt-0 pt-0">Max file size is 1048kB</p>

            @error('image')
                {{-- <div class="text-danger small">{{ $message }}</div> --}}
            @enderror
    </div>

    <button type="submit" class="btn btn-primary btn-md text-white">Post</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.category-checkbox');
            const maxAllowed = 3;

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    const checkedCount = document.querySelectorAll('.category-checkbox:checked')
                        .length;

                    if (checkedCount >= maxAllowed) {
                        checkboxes.forEach(box => {
                            if (!box.checked) {
                                box.disabled = true;
                            }
                        });
                    } else {
                        checkboxes.forEach(box => box.disabled = false);
                    }
                });
            });
        });
    </script>

@endsection
