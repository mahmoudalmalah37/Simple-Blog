<div>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-preview">
                    <h2 class="post-title text-center">Add Post</h2>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form wire:submit.prevent="addPost">

                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" wire:model="title"  wire:keyup="generateSlug">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                         <div class="form-group mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" wire:model="slug">
                            @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="comment">content</label>
                            <textarea class="form-control" id="comment" rows="3" wire:model="content"></textarea>
                            @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" wire:model="image">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
