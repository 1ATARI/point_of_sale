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
                        <h1 class="m-0">{{trans('msite.edit_client')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.welcome')}}">{{trans('msite.Home')}}</a></li>


                            <li class="breadcrumb-item "><a
                                    href="{{route('dashboard.clients.index')}}">{{trans('msite.clients')}}</a></li>


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
                            <h5 class="modal-title">{{trans('msite.create_new_user')}}</h5>
                        </div>
                        <div class="card-body">

                            <form action="{{route('dashboard.clients.update' , $client->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('put')}}
                                <div class="form-group">
                                    <label>@lang('msite.name')</label>
                                    <input type="text" name="name" class="form-control" id="" value="{{$client->name}}">
                                </div>

                                @for($i=0 ; $i<2 ;$i++ )
                                    <div class="form-group">
                                        <label>@lang('msite.phone')</label>
                                        <input type="text" name="phone[]" class="form-control" value="{{$client->phone[$i]??''}}">
                                    </div>
                                @endfor
                                <div class="form-group">
                                    <label>@lang('msite.address')</label>
                                    <textarea name="address" class="form-control">{{$client->address}}</textarea>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> @lang('msite.create')</button>
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
