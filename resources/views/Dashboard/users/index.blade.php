@extends('includes.dashboard')

@section('title')
    @lang('msite.users')

@stop


@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0 ml-1">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{trans('msite.users')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.welcome')}}">{{trans('msite.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('msite.users')}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">

            <div class="row">
                <div class="card-body">
                    <div class="card card-statistics h-100">
                        @include('includes.errors')
                        <div class="card-header" style="background-color:rgba(0,0,0,.03)">
                            <h5 class="modal-title"style="display: inline">{{trans('msite.users')}} </h5>
                            <small> {{$users->total()}}</small>
                        </div>
                        <br>
                        <form action="{{route('dashboard.users.index')}}" method="get">
                            <div class="row">
                                <div class="col-md-3 ml-3">
                                    <input type="text" name="search" class="form-control" id=""
                                           placeholder="{{trans('msite.search')}}" value="{{Request()->search}}">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search fa-fw"></i>
                                        {{trans('msite.search')}}</button>
                                    @if(auth()->user()->hasPermission('users_create'))
                                        <a href="{{route('dashboard.users.create')}}" class="btn btn-primary">
                                            <i class="fas fa-plus-square fa-fw"></i>

                                            {{trans('msite.create')}}</a>
                                    @else
                                        <a href="#" class="btn btn-primary disabled">
                                            <i class="fas fa-plus-square fa-fw"></i>

                                            {{trans('msite.create')}}</a>
                                    @endif

                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            @if($users->count()>0)
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <th>#</th>
                                    <th>@lang('msite.first_name')</th>
                                    <th>@lang('msite.last_name')</th>
                                    <th>@lang('msite.email')</th>
                                    <th>@lang('msite.users_image')</th>
                                    <th>@lang('msite.process')</th>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $index=>$user)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$user->first_name}}</td>
                                            <td>{{$user->last_name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td><img src="{{$user->image_path}}" style="width: 100px" class="img-thumbnail"></td>

                                            <td class="project-actions text-left">
                                                @if(auth()->user()->hasPermission('users_update'))

                                                    <a class="btn btn-info btn-sm"
                                                       href="{{route('dashboard.users.edit' , $user->id)}}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i> {{trans('msite.edit')}}</a>
                                                @else
                                                    <a class="btn btn-info btn-sm disabled" href="#">
                                                        <i class="fas fa-pencil-alt">
                                                        </i> {{trans('msite.edit')}}</a>
                                                @endif

                                                @if(auth()->user()->hasPermission('users_delete'))
                                                        <button type="button" class="btn delete btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete{{$user->id}}">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                            {{trans('msite.delete')}}
                                                        </button>


                                                        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}


                                                        <div class="modal fade" id="delete{{$user->id}}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title"><i class="icon fas fa-exclamation-triangle"></i> @lang('msite.confirm_delete')</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>@lang('msite.are_you_sure_delete') "{{$user->first_name . " " . $user->last_name}}"</p>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">

                                                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:rgba(0,0,0,.03)">@lang('msite.close')</button>


                                                                        <button type="submit" class="btn delete btn-danger">@lang('msite.confirm')</button>

                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        </form>


                                                @else
                                                    <a class="btn btn-danger btn-sm disabled" href="#">
                                                        <i class="fas fa-trash">
                                                        </i>
                                                        {{trans('msite.delete')}}
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            <br>
                                {{$users->appends(request()->query())->links()}}

                            @else
                               <h4 class="text-center border border-secondary p-2"> {{trans('msite.no_data_found')}}</h4>
                            @endif

                        </div>



                    </div>
                </div>
            </div>

        </section>

    </div>

    <div class="modal" tabindex="-1" role="dialog" id="delete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div






@endsection
@section('js')
@endsection
