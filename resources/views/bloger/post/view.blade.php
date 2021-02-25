@extends("admin.layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div>
                    <div class="post_slider">
                        @foreach(json_decode($post->files) as $image)
                            <img  src="{{asset('storage/' . $image)}}">
                        @endforeach
                    </div>
                    <small>{{$post->category->name}}</small>
                    <h5 >{{$post->title}}</h5>
                    <p >{{$post->body}}</p>
                    @foreach($post->hashtags as $hashtag)
                        <small>#{{$hashtag->name}}</small>
                    @endforeach
                    <br>
                    <small>{{ ucwords(\Carbon\Carbon::parse($post->created_at)->format('j F, Y'))}}</small>
                    <br>
                    <small>{{$post->user->nickname ?  $post->user->nickname  : $post->user->name }}</small>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
@endsection

@section('footer')

<script>
    $(document).ready(function(){
        $('.post_slider').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
    });
    });

</script>


    @endsection