@extends('admin.layouts.app');

@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Create</strong> Post
                            </div>
                            <div class="card-body card-block">
                                <form action="{{ route('post-store') }}" method="post" class="" id="category-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nf-email" class=" form-control-label">Title</label>
                                        <input type="text"  name="title" value="{{old('title')}}" placeholder="Enter Title..." class="form-control">
                                        @if($errors->has('title'))
                                            <small class="help-block text-danger">{{$errors->first('title')}}</small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="nf-email" class=" form-control-label">Body</label>
                                        <textarea type=""  name="body" value="{{old('body')}}" placeholder="Enter Body..." class="form-control"></textarea>
                                        @if($errors->has('body'))
                                            <small class="help-block text-danger">{{$errors->first('body')}}</small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="nf-email" class=" form-control-label">Upload picture</label>
                                        <input type="file"  name="files[]" value="{{old('file')}}" class="form-control" multiple="multiple">
                                        @if($errors->has('file'))
                                            <small class="help-block text-danger">{{$errors->first('file')}}</small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="nf-email" class=" form-control-label">Hashtag</label>
                                        <select class="js-example-basic-multiple form-control" style="width: 100%!important;" name="hashtags[]" multiple="multiple">
                                            @foreach($hashtags as $hashtag)
                                                <option value="{{$hashtag->id}}">{{$hashtag->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('hashtag'))
                                            <small class="help-block text-danger">{{$errors->first('hashtag')}}</small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="nf-email" class=" form-control-label">Category</label>
                                        <select class="form-control" name="category" id="exampleFormControlSelect1">
                                            <option disabled selected>Select category</option>
                                        @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('category'))
                                            <small class="help-block text-danger">{{$errors->first('category')}}</small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="nf-email" class=" form-control-label">Status</label>
                                        <select   name="status"  class="form-control">
                                            <option disabled selected>Select status</option>
                                            <option value="1">Active</option>
                                            <option value="2">Disabled</option>
                                        </select>
                                        @if($errors->has('status'))
                                            <small class="help-block text-danger">{{$errors->first('status')}}</small>
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

@section('footer')
    <script deferre>
        $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection