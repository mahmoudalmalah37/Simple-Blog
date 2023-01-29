@if(count($posts) > 0)
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Post preview-->
                @foreach($posts as $post)
                    <div class="post-preview">
                        <a href="{{ route('post.detail',['slug'=>$post->slug])}}">
                            <h2 class="post-title">{{$post->title}}</h2>
                            <h3 class="post-subtitle">
                                {{Str::limit($post->content, 20)}}
                            </h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#">
                                {{$post->author ?? 'Anonymous'}}
                            </a>
                            on {{ $post->created_at->format('d M Y') }}
                        </p>
                            @auth
                                @if(Auth::user()->utype == 'ADM')
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin.edit_post',['post_id'=>$post->id])}}" class="btn btn-primary">Edit</a>
                                        <button wire:click="deletePost({{$post->id}})" class="btn btn-danger">Delete</button>
                                    </div>
                                @endif
                            @endauth
                    </div>
                @endforeach
                <!-- Divider-->
                <hr class="my-4" />
                <!-- Pager-->
                <div class="d-flex justify-content-end mb-4">
                   <a class="btn btn-primary text-uppercase" href="{{ $posts->links() }}">Older Posts →</a>
                </div>
            </div>
                @livewire('common.top-views')
        </div>
    </div>
@else
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <h2 class="post-title">No Post Found</h2>
            </div>
        </div>
    </div>
@endif
