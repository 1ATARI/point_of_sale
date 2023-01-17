@extends('includes.dashboard')

@section('title')
    @lang('msite.product')

@stop


@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0 ml-1">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{trans('msite.products')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.welcome')}}">{{trans('msite.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('msite.products')}}</li>
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
                            <h5 class="modal-title"style="display: inline">{{trans('msite.products')}} </h5>
                            <small> {{$products->total()}}</small>
                        </div>
                        <br>
                        <form action="{{route('dashboard.products.index')}}" method="get">
                            <div class="row">
                                <div class="col-md-3 ml-3">
                                    <input type="text" name="search" class="form-control" id=""
                                           placeholder="{{trans('msite.search')}}" value="{{request()->search}}">
                                </div>

                                <div class=" mb-3">
                                <select name="category_id"  class="custom-select" id="inputGroupSelect02">
                                    <option class="form-control">@lang('msite.all_categories')</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach

                                </select>


                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search fa-fw"></i>
                                        {{trans('msite.search')}}</button>
                                    @if(auth()->user()->hasPermission('products_create'))
                                        <a href="{{route('dashboard.products.create')}}" class="btn btn-primary">
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
                            @if($products->count()>0)










                                <table id="example2" class="table table-bordered table-hover">

                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('msite.name')</th>
                                        <th>@lang('msite.description')</th>
                                        <th>@lang('msite.category')</th>
                                        <th>@lang('msite.image')</th>
                                        <th>@lang('msite.purchase_price')</th>
                                        <th>@lang('msite.sale_price')</th>
                                        <th>@lang('msite.profit_percent') %</th>
                                        <th>@lang('msite.stock')</th>
                                        <th>@lang('msite.process')</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($products as $index=>$product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{!! $product->description !!}</td>
                                            @if(app()->getLocale() =='en')

                                            <td><a href="{{route('dashboard.categories.index' , ['search'=>$product->category->name])}}">{{ $product->category->name}}</a></td>
                                            @else
                                                <td><a href="{{route('dashboard.categories.index' , ['search'=>$product->category->name])}}">{{ $product->category->name }}</a></td>

                                            @endif
                                            <td><img src="{{ $product->image_path }}" style="width: 100px; height: 100px"  class="img-thumbnail" alt=""></td>
                                            <td>{{ $product->purchase_price }}</td>
                                            <td>{{ $product->sale_price }}</td>
                                            <td>{{ $product->profit_percent }} %</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                @if (auth()->user()->hasPermission('products_update'))
                                                    <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('msite.edit')</a>
                                                @else
                                                    <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('msite.edit')</a>
                                                @endif
                                                @if (auth()->user()->hasPermission('products_delete'))
                                                    <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post" style="display: inline-block">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}

                                                        <button type="button" class="btn delete btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete-{{$product->id}}">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                            {{trans('msite.delete')}}
                                                        </button>


                                                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}


                                                            <div class="modal fade" id="delete-{{$product->id}}">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title"><i class="icon fas fa-exclamation-triangle"></i> @lang('msite.confirm_delete')</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>@lang('msite.are_you_sure_delete') "{{$product->name}}"</p>
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
                                                    <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('msite.delete')</button>
                                                @endif
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>

                                </table><!-- end of table -->











                                <br>
                                {{$products->appends(request()->query())->links()}}

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
    </div>






@endsection
@section('js')
@endsection
