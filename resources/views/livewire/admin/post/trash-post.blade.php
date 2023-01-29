<div>
    <div class="card">
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
                        @if(Auth::user()->name == $post->author || Auth::user()->utype == 'ADM')
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
                                    <button wire:click="restore({{ $post->id }})" class="btn btn-info">Restore</button>
                                    <button wire:click="delete({{ $post->id }})" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
