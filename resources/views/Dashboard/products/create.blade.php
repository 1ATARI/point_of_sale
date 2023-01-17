@extends('includes.dashboard')

@section('title')
@lang('msite.create')
@stop


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0 ml-1">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{trans('msite.create_product')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.welcome')}}">{{trans('msite.Home')}}</a></li>


                            <li class="breadcrumb-item "><a
                                    href="{{route('dashboard.products.index')}}">{{trans('msite.products')}}</a></li>


                            <li class="breadcrumb-item active">{{trans('msite.create')}}</li>
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
                            <h5 class="modal-title">{{trans('msite.create_new_product')}}</h5>
                        </div>
                        <div class="card-body">

                            <form action="{{route('dashboard.products.store')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('post')}}

                                <div class="form-group">

                                        <select name="category_id" class="custom-select" id="inputGroupSelect02">
                                            <option selected disabled>@lang('msite.all_categories')</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"{{old('category_id')==$category->id ? 'selected' :''}}>{{$category->name}}</option>


                                            @endforeach
                                        </select>


                                </div>

                                <div class="form-group">
                                    <label>{{trans('msite.name_ar')}}</label>
                                    <input type="text" name="name_ar" class="form-control"
                                           value="{{old('name_ar')}}" >
                                </div>
                                <div class="form-group">
                                    <label>{{trans('msite.name_en')}}</label>
                                    <input type="text" name="name_en" class="form-control"
                                           value="{{old('name_en')}}" >
                                </div>

                                <div class="form-group">
                                    <label>{{trans('msite.description_ar')}}</label>
                                    <textarea  name="description_ar" class="form-control ckeditor">{{old('description_ar')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>{{trans('msite.description_en')}}</label>
                                    <textarea  name="description_en" class="form-control ckeditor">{{old('description_ar')}}</textarea>
                                </div>
                                <div class="form-group" >
                                    <label>{{trans('msite.image')}}</label>
                                    <input type="file" name="image" accept="image/*" class="form-control image">
                                </div>
                                <div class="form-group" >
                                    <img src="{{asset('uploads/products_image/default.png')}}" style="width: 100px" class="img-thumbnail image-preview">
                                </div>

                                <div class="form-group" >
                                    <label>{{trans('msite.purchase_price')}}</label>
                                    <input type="number" name="purchase_price"  step="0.01" class="form-control"value="{{old('purchase_price')}}" >
                                </div>

                                <div class="form-group" >
                                    <label>{{trans('msite.sale_price')}}</label>
                                    <input type="number" name="sale_price" step="0.01"  class="form-control" value="{{old('sale_price')}}">
                                </div>

                                <div class="form-group" >
                                    <label>{{trans('msite.stock')}}</label>
                                    <input type="number" name="stock"  class="form-control" value="{{old('stock')}}">
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
