@foreach ($all_categories as $category)
    <div class="modal fade" id="edit-category-{{ $category->id }}" tabindex="-1"
        aria-labelledby="editModalLabel-{{ $category->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-{{ $category->id }}">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 編集フォーム -->
                    <form action="{{ route('admin.updateCategory', $category->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="name" value="{{ old('name', $category->name) }}"
                            class="form-control">
                        <button type="submit" class="btn btn-success mt-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-category-{{ $category->id }}" tabindex="-1"
        aria-labelledby="deleteModalLabel-{{ $category->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-{{ $category->id }}">Delete Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete category <strong>{{ $category->name }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.destroyCategory', $category->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
