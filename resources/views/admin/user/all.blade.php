@extends("admin.layouts.app")

@section("content")

    <div class="row mt-5 ">
        <div class="col-md-6 mt-5">
            <!-- DATA TABLE -->
            <h3 class="title-5 m-b-35 mt-5">data table</h3>
            @if(session('success'))
                <div class="alert alert-success mt-5" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                    <tr>
                        <th>N</th>
                        <th>name</th>
                        <th>nickname</th>
                        <th>email</th>
                        <th>status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                    <tr class="tr-shadow">
                        <td>{{$key + 1 + ($users->currentPage() * $users->perPage()) - $users->perPage()}}</td>
                        <td>{{$user->name}}</td>
                        <td class="desc">{{$user->nickname}}</td>
                        <td>
                            <span class="block-email">{{$user->email}}</span>
                        </td>
                        <td>
                            @if($user->status == 0)
                                <span class="text-danger">Deactivated</span>
                            @else()
                                <span class="text-success">Activated</span>
                            @endif
                        </td>
                        <td>
                            <div class="table-data-feature">
                                <a href="{{route('toogle-status', [$user->id])}}" class="item" data-placement="top" title="{{$user->status ? 'Deactivated' : 'Activate' }}">
                                    @if($user->status == 0)
                                        <i class="fa fa-refresh text-success" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-refresh text-danger" aria-hidden="true"></i>
                                    @endif
                                        <a href="" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a href="" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>



@endsection