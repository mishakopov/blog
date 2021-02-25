@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($categories as $category)
                    <a href="{{ route('main',['category' => $category->id]) }}">
                        <span>{{$category->name}}</span>
                    </a>
                @endforeach
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <form action="{{ route('main' )}}" method="get">
                        <input type="text" name="search" class="form-control" placeholder="Search post" aria-describedby="basic-addon2">
                        <input type="hidden" name="category" value="{{ $activeCategory }}">
                        <div class="input-group-append">
                            <button  class="input-group-text" id="basic-addon2">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        @foreach($posts as $post)
                            @foreach(json_decode($post->files) as $image)
                                <img class="card-img-top" src="{{asset('storage/' . $image)}}">
                            @endforeach
                            <div class="card-body">
                                <h5 class="card-title">{{$post->title}}</h5>
                                <p class="card-text">{{$post->body}}</p>
                                <a href="{{route('post-view' , $post->id)}}" class="btn btn-primary">view more</a>
                                <a href="{{route('post-edit', $post->id)}}" class="item"  data-placement="top" title="Edit">
                                    <i class="zmdi zmdi-edit"></i>
                                </a>
                                <a href="{{route('post-delete', $post->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
        {{$posts->appends(['category' => $activeCategory])->links()}}

    </div>


@endsection