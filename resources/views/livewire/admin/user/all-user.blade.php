<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold">All Users</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 400px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search" wire:model="searchTerm">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <img src="{{ asset('storage/profile/') }}/{{$user->profile_photo_path}}" alt="profile" width="50px" height="50px">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->utype }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>
                                <a
                                    href="{{ route('edit-user',['user_id'=>$user->id]) }}"
                                   class="btn btn-primary btn-sm">Edit</a>
                                <button wire:click="deleteUser({{ $user->id }})" class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
