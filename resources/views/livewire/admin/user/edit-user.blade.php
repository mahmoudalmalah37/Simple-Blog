<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Edit User</h4>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="updateUser">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('name') has-danger @enderror">
                                    <label>Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" wire:model="name">
                                    @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('email') has-danger @enderror">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" wire:model="email">
                                    @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('utype') has-danger @enderror">
                                    <label>Role</label>
                                    <select class="form-control @error('utype') is-invalid @enderror" wire:model="utype">
                                        <option value="">Select Role</option>
                                            <option value="ADM">Admin</option>
                                            <option value="USR">User</option>

                                    </select>
                                    @error('utype') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('newimage') has-danger @enderror">
                                    <label>Profile Photo</label>
                                    <input type="file" class="form-control @error('newimage') is-invalid @enderror" wire:model="newimage">
                                    @if( $newimage )
                                        <img src="{{ $newimage->temporaryUrl() }}" width="120" class="mt-2">
                                    @else
                                        <img src="{{ asset('storage/profile/') }}/{{$newimage->profile_photo_path ?? 'No image'}}" width="120" class="mt-2">
                                    @endif
                                    @error('newimage') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('password') has-danger @enderror">
                                    <label>Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" wire:model="password">
                                    @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-round">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
