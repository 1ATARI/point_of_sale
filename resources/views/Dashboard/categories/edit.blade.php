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
                        <h1 class="m-0">{{trans('msite.edit_category')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.welcome')}}">{{trans('msite.Home')}}</a></li>


                            <li class="breadcrumb-item "><a
                                    href="{{route('dashboard.categories.index')}}">{{trans('msite.categories')}}</a></li>


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
                            <h5 class="modal-title">{{trans('msite.edit_category')}}</h5>
                        </div>
                        <div class="card-body">

                            <form action="{{route('dashboard.categories.update' , $category->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('put')}}
                                <div class="form-group">
                                    <label>{{trans('msite.name_ar')}}</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{$category->getTranslation('name','ar')}}">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('msite.name_en')}}</label>
                                    <input type="text" name="name_en" class="form-control"
                                           value="{{$category->getTranslation('name','en')}}">
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
