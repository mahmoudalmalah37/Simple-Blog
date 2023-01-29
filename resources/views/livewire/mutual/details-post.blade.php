<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <h2 class="section-heading mb-4 text-break text-justify text-wrap">
                    {{ $posts->title }}
                </h2>
                <p class="mb-4 text-break text-justify text-wrap ">
                    {{ $posts->content }}
                </p>

                <div class="d-flex justify-content-between">
                    <img
                        class="img-fluid"
                        src="{{asset('storage/Post/')}}/{{$posts->image}}"
                        alt="Responsive image"
                        onclick="window.open(this.src)"
                    />
                </div>

                <p class="text-muted mb-4" style="font-size: 1.0rem;">
                    Post-At : {{ $posts->date->format('d M Y') }}
                    <br>
                    Type By : {{ $posts->author }}
                </p>
            </div>

            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                            @if( $isLiked )
                                <button wire:click="like" class="btn btn-outline-danger">
                                    <i class="far fa-heart"></i>
                                    Like ({{ $likes->count() }})
                                </button>
                            @else
                                <button wire:click="like" class="btn btn-outline-danger">
                                    <i class="fas fa-heart"></i>
                                    Like ({{ $likes->count() }})
                                </button>
                            @endif
                            @if( $isDisliked )
                                <button wire:click="dislike" class="btn btn-outline-danger">
                                    <i class="far fa-thumbs-down"></i>
                                    Dislike ({{ $dislike->count() }})
                                </button>
                            @else
                                <button wire:click="dislike" class="btn btn-outline-danger">
                                    <i class="fas fa-thumbs-down"></i>
                                    Dislike ({{ $dislike->count() }})
                                </button>
                            @endif
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Comments</h4>
                    </div>
                    <div class="card-body">
                        @if (count($comments) > 0)
                            @foreach ($comments as $comment)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img
                                                    src="{{asset('storage/profile/')}}/{{$comment->user->profile_photo_path}}"
                                                    class="img img-rounded img-fluid"/>
                                                <p class="text-secondary text-center">{{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                            <div class="col-md-10">
                                                <p>
                                                    <a class="float-left text-primary" href="#"><strong>{{ $comment->user->name }}</strong></a>
                                                      <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                                </p>
                                                <div class="clearfix"></div>
                                                <p>{{ $comment->comment }}</p>
                                            </div>

                                            @auth()
                                            @if (auth()->user()->id == $comment->user_id)
                                                <button class="btn btn-sm btn-danger" wire:click="delete({{ $comment->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning" wire:click="edit({{ $comment->id }})">
                                                    <i class="fa fa-edit text-white"></i>
                                                </button>
                                            @endif
                                        @endauth
                                    </div>
                            </div>
                            @endforeach
                        @else
                            <p class="text-center">No comments yet.</p>
                        @endif
                    </div>
                </div>
            </div>
            @if (Auth::check())
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Comment</h4>
                    </div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($updateMode)
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="comment">Comment</label>
                                    <textarea
                                        wire:model="comment"
                                        class="form-control"
                                        id="comment"
                                        rows="3"
                                    ></textarea>
                                    @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <button
                                    wire:click="update"
                                    class="btn btn-primary btn-sm"
                                >
                                    Update
                                </button>
                                <button
                                    wire:click="cancel"
                                    class="btn btn-danger btn-sm"
                                >
                                    Cancel
                                </button>
                            </div>
                        @else
                            <div class="card-body">
                                <form wire:submit.prevent="addComment">
                                    <div class="form-group mb-3">
                                        <label for="comment">Comment</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="comment"
                                            placeholder="Enter name"
                                            wire:model="comment"
                                        />
                                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </form>
                            </div>
                    @endif
                </div>
            </div>
                @else
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="card">
                            <div class="card-header">
                                <h4>Add Comment</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-center">Please login to add comment.</p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                OR
                                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                            </div>
                        </div>
                    </div>
            @endif
        </div>
    </div>
</article>
