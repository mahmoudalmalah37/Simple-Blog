<div>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <h2 class="post-title text-center">Top Views</h2>
                    @foreach($posts as $post)
                        <div class="post-preview">
                            <a href="{{ route('post.detail',['slug'=>$post->slug])}}">
                                <h2 class="post-title text-danger">{{$post->title}}</h2>
                                <h3 class="post-subtitle">
                                    {{Str::limit($post->commet, 20, '...')}}
                                </h3>
                            </a>
                            <p class="post-meta">
                                Posted by
                                <a href="#">
                                    {{$post->author ?? 'Anonymous'}}
                                </a>
                                @if( $post->created_at->format('d M Y') == Carbon\Carbon::now()->format('d M Y') )
                                    on {{ $post->created_at->format('d M Y') }}
                                @else
                                    on {{ $post->created_at->diffForHumans() }}
                                @endif
                                <span class="badge bg-primary text-wrap">
                                    {{ $post->views }} Views
                                 </span>
                                <span class="badge bg-success text-wrap">
                                    {{ $post->likes }} Likes
                                 </span>
                            </p>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
</div>

