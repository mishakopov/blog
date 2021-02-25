@extends('admin.layouts.app');


@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Create</strong> Category
                            </div>
                            <div class="card-body card-block">
                                <form action="{{ route('categories-store') }}" method="post" class="" id="category-form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nf-email" class=" form-control-label">Name</label>
                                        <input type="text"  name="name" value="{{old('name')}}" placeholder="Enter Name..." class="form-control">
                                        @if($errors->has('name'))
                                            <small class="help-block text-danger">{{$errors->first('name')}}</small>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Status</label>
                                        <select class="form-control" name="status" id="exampleFormControlSelect1">
                                            <option disabled value="" selected>Select Status</option>
                                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Disabled</option>
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