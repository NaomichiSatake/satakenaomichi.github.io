@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="container">
        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

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
                @foreach ($all_categories as $category)
                    <input type="checkbox" name="category[]" id="{{ $category->id }}" value="{{ $category->id }}"
                        class="category-checkbox"
                        {{ $post->categoryPost->where('category_id', $category->id)->isNotEmpty() ? 'checked' : '' }}>
                    <label for="{{ $category->id }}" class="me-1">{{ $category->name }}</label>
                @endforeach

                @error('category')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror

            </div>

            <h4 class="mt-3">Description</h4>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control" value="">{{ old('description', $post->description) }}</textarea>

            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

            <h4 class="mt-3 row">Image</h4>
            <div class="col-6">


                <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="img-thumbnail w-100">
                <input type="file" name="image" id="image" class="form-control">
                <p class="text-lighter">Acceptable formats:jpeg,jpg,png,gif only</p>
                <p class="text-lighter mt-0 pt-0">Max file size is 1048kB</p>
            </div>

            @error('image')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
    </div>

    <button type="submit" class="btn btn-warning btn-md text-white">Save</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.category-checkbox');
            const maxAllowed = 3;

            function updateCheckboxState() {
                const checkedCount = document.querySelectorAll('.category-checkbox:checked').length;

                if (checkedCount >= maxAllowed) {
                    checkboxes.forEach(box => {
                        if (!box.checked) {
                            box.disabled = true;
                        }
                    });
                } else {
                    checkboxes.forEach(box => box.disabled = false);
                }
            }

            // 初期状態でのチェックボックスの状態を確認し、制御を反映
            updateCheckboxState();

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateCheckboxState);
            });
        });
    </script>


@endsection
