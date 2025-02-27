{{-- Deactivate --}}
<div class="modal fade" id="deactivate-post-{{$post->id}}">
    <div class="modal-dialog">
        <div class="modal-content modal-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-post-slash"></i>Invisualize post
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to invisualize <span class="fw-bold">{{$post->id}}</span>
                <img src="{{ $post->image }}" alt="{{ $post->id }}" class="d-block mx-auto image-lg">
            </div>

            <div class="modal-footer border-0">
                <form action="{{route('admin.deactivatepost',$post->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm" >Invisualize</button>

                </form>
            </div>
        </div>
    </div>
</div>

{{-- Activate --}}
<div class="modal fade" id="activate-post-{{$post->id}}">
    <div class="modal-dialog">
        <div class="modal-content modal-success">
            <div class="modal-header border-success">
                <h3 class="h5 modal-title text-success">
                    <i class="fa-solid fa-newspaper-check"></i>Visualize post
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to visualize <span class="fw-bold">{{$post->id}}</span>
                <img src="{{ $post->image }}" alt="{{ $post->id }}" class="d-block mx-auto image-lg">
            </div>

            <div class="modal-footer border-0">
                <form action="{{route('admin.activatepost',$post->id)}}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm" >Visualize</button>

                </form>
            </div>
        </div>
    </div>
</div>
