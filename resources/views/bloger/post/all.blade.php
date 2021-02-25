@extends("admin.layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- DATA TABLE -->
            <h3 class="title-5 m-b-35 mt-5">data table</h3>
            <div class="table-data__tool ">
                <div class="table-data__tool-right">
                    <a href="{{route('create-post')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>add item</a>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search post" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button  class="input-group-text" id="basic-addon2">Search</button>
                </div>
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

</div>

@endsection