@extends('includes.dashboard')

@section('title')
    @lang('msite.edit')
@stop


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0 ml-1">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{trans('msite.edit_user')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.welcome')}}">{{trans('msite.Home')}}</a></li>


                            <li class="breadcrumb-item "><a
                                    href="{{route('dashboard.users.index')}}">{{trans('msite.users')}}</a></li>


                            <li class="breadcrumb-item active">{{trans('msite.edit')}}</li>
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
                            <h5 class="modal-title">{{trans('msite.edit_user')}}</h5>
                        </div>
                        <div class="card-body">

                            <form action="{{route('dashboard.users.update' , $user->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('put')}}
                                <div class="form-group">
                                    <label>{{trans('msite.first_name')}}</label>
                                    <input type="text" name="first_name" class="form-control"
                                           value="{{$user->first_name}}">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('msite.last_name')}}</label>
                                    <input type="text" name="last_name" class="form-control"
                                           value="{{$user->last_name}}">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('msite.email')}}</label>
                                    <input type="email" name="email" class="form-control" value="{{$user->email}}">
                                </div>
                                <div class="form-group" >
                                    <label>{{trans('msite.image')}}</label>
                                    <input type="file" name="image" accept="image/*" class="form-control image">
                                </div>
                                <div class="form-group" >
                                    <img src="{{$user->image_path}}" style="width: 100px" class="img-thumbnail image-preview">
                                </div>


                                <div class="form-group">
                                    <label>{{trans('msite.new_password')}}</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('msite.password_confirmation')}}</label>
                                    <input type="password" name="password_confirmation" class="form-control">

                                    <br>
                                </div>




                                <div class="form-group">
                                    <label>@lang('msite.permissions')</label>
                                    <div class="card card-primary card-outline card-tabs">

                                        @php
                                            $models = ['users', 'categories', 'products','clients' , 'orders'];
                                            $maps = ['create', 'read', 'update', 'delete'];
                                        @endphp

                                        <ul class="nav nav-tabs">
                                            @foreach ($models as $index=>$model)
                                                <li class="nav-item {{ $index == 0 ? 'active' : '' }}"><a class="nav-link" href="#{{ $model }}" data-toggle="tab">@lang('msite.' . $model)</a></li>
                                            @endforeach
                                        </ul>
                                        <br>
                                        <div class="tab-content">

                                            @foreach ($models as $index=>$model)

                                                <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                                    @foreach ($maps as $map)
                                                        <label><input class="ml-1" type="checkbox"  name="permissions[]" {{$user->hasPermission($model .'_' . $map)?'checked':''}} value="{{$model .'_'. $map}}"> @lang('msite.' . $map)</label>
                                                    @endforeach

                                                </div>

                                            @endforeach

                                        </div><!-- end of tab content -->

                                    </div><!-- end of nav tabs -->

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-edit"></i> @lang('msite.edit')</button>
                                </div>

                            </form>

                        </div>


                    </div>
                </div>
            </div>

        </section>
    </div>

@endsection
@section('js')

@endsection
