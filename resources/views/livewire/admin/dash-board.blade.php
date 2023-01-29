<div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Dashboard</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-center">Total Users</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="text-center">{{ $totalUsers }}</h1>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('all-user') }}" class="btn btn-primary btn-block">View Users</a>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('add-user') }}" class="btn btn-primary btn-block">Add User</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-center">Total Posts</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="text-center">{{ $totalPosts }}</h1>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('all-post') }}" class="btn btn-primary btn-block">View Posts</a>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('add-post') }}" class="btn btn-primary btn-block">Add Post</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-center">Total Comments</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="text-center">{{ $totalComments }}</h1>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="" class="btn btn-primary btn-block">View Comments</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
