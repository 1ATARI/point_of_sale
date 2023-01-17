@extends('includes.dashboard')

@section('title')
    @lang('msite.edit_product')
@stop


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0 ml-1">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{trans('msite.edit_product')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.welcome')}}">{{trans('msite.Home')}}</a></li>


                            <li class="breadcrumb-item "><a
                                    href="{{route('dashboard.products.index')}}">{{trans('msite.products')}}</a></li>


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
                            <h5 class="modal-title">{{trans('msite.edit_product')}}</h5>
                        </div>
                        <div class="card-body">

                            <form action="{{route('dashboard.products.update' , $product->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('put')}}

                                <div class="form-group">

                                    <select name="category_id" class="form-select" >
                                        <option selected disabled>@lang('msite.all_categories')</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"{{$product->category_id==$category->id ? 'selected' :''}}>{{$category->name}}</option>


                                        @endforeach
                                    </select>


                                </div>

                                <div class="form-group">
                                    <label>{{trans('msite.name_ar')}}</label>
                                    <input type="text" name="name_ar" class="form-control"
                                           value="{{$product->getTranslation('name','ar')}}" >
                                </div>
                                <div class="form-group">
                                    <label>{{trans('msite.name_en')}}</label>
                                    <input type="text" name="name_en" class="form-control"
                                           value="{{$product->getTranslation('name','en')}}" >
                                </div>

                                <div class="form-group">
                                    <label>{{trans('msite.description_ar')}}</label>
                                    <textarea  name="description_ar" class="form-control ckeditor">{{$product->getTranslation('description','ar')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>{{trans('msite.description_en')}}</label>
                                    <textarea  name="description_en" class="form-control ckeditor">{{$product->getTranslation('description','en')}}</textarea>
                                </div>
                                <div class="form-group" >
                                    <label>{{trans('msite.image')}}</label>
                                    <input type="file" name="image" accept="image/*" class="form-control image">
                                </div>
                                <div class="form-group" >
                                    <img src="{{$product->image_path}}" style="width: 100px" class="img-thumbnail image-preview">
                                </div>

                                <div class="form-group" >
                                    <label>{{trans('msite.purchase_price')}}</label>
                                    <input type="number" name="purchase_price" step="0.01"  class="form-control"value="{{$product->purchase_price}}" >
                                </div>

                                <div class="form-group" >
                                    <label>{{trans('msite.sale_price')}}</label>
                                    <input type="number" name="sale_price" step="0.01"  class="form-control" value="{{$product->sale_price}}">
                                </div>

                                <div class="form-group" >
                                    <label>{{trans('msite.stock')}}</label>
                                    <input type="number" name="stock"  class="form-control" value="{{$product->stock}}">
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> @lang('msite.edit')</button>
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
