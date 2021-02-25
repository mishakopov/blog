@extends('admin.layouts.app');


@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Edit</strong> Post
                            </div>
                            <div class="card-body card-block">
                                <form action="{{route('post-update', $posts->id)}}"  method="post" class="" id="category-form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nf-email" class=" form-control-label">Title</label>
                                        <input type="text"  name="title" value="{{old('title') ? old('title')  : $posts->title}}" placeholder="Enter Name..." class="form-control">
                                        @if($errors->has('title'))
                                            <small class="help-block text-danger">{{$errors->first('title')}}</small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="nf-email" class=" form-control-label">Body</label>
                                        <input type="text"  name="body" value="{{old('body') ? old('body')  : $posts->body}}" placeholder="Enter Name..." class="form-control">
                                        @if($errors->has('body'))
                                            <small class="help-block text-danger">{{$errors->first('body')}}</small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="nf-email" class=" form-control-label">Upload picture</label>
                                        <input type="text"  name="files[]" value="{{old('body') ? old('body')  : $posts->body}}" placeholder="Enter Name..." class="form-control">
                                        @if($errors->has('body'))
                                            <small class="help-block text-danger">{{$errors->first('body')}}</small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="nf-email" class=" form-control-label">Hashtag</label>
                                        <select class="js-example-basic-multiple form-control" style="width: 100%!important;" name="hashtags[]" multiple="multiple">
                                            @foreach($hashtags as $hashtag)
                                                <option  {{ $posts->hashtags->pluck('id')->search($hashtag->id) !== false ? 'selected' : ''}} value="{{$hashtag->id}}">{{$hashtag->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('hashtag'))
                                            <small class="help-block text-danger">{{$errors->first('hashtag')}}</small>
                                        @endif
                                    </div>
                                </form>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm" form="category-form">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection