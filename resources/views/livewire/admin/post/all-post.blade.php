<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold">All Post</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search" wire:model="searchTerm">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <a href="{{ route('add-post') }}" class="btn btn-primary float-lg-end">Add Post</a>
                <a href="{{ route('trash-post') }}" class="btn btn-primary float-lg-end">Trash Post</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Post Image</th>
                    <th>Post Title</th>
                    <th>Post Slug</th>
                    <th>Author</th>
                    <th>Views</th>
                    <th>date</th>
                    <th>Delete At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            <img src="{{ asset('storage/post/' . $post->image) }}" alt="" width="100">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->author }}</td>
                        <td>{{ $post->views }}</td>
                        <td>{{ $post->date->diffForHumans() }}</td>
                        <td>{{ $post->deleted_at ?? 'Not Remove'}}</td>
                        <td>
                            <a href="{{ route('admin.edit_post', $post->id) }}" class="btn btn-info">Edit</a>
                            <button wire:click="deletePost({{ $post->id }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
